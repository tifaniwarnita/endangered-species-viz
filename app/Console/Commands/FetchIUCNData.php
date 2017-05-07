<?php

namespace App\Console\Commands;

use App\Model\Country;
use App\Model\Species;
use App\Model\Threat;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class FetchIUCNData extends Command
{
    const BASE_URL = "http://apiv3.iucnredlist.org/api/v3/";
    const API_SPECIES_BY_COUNTRY = "country/getspecies/";
    const API_SPECIES_BY_ID = "species/id/";
    const API_NARRATIVE_BY_SPECIES_ID = "species/narrative/id/";
    const API_THREATS_BY_SPECIES_ID = "threats/species/id/";
    const TOKEN = "9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fetchiucndata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get animals data from IUCN API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $countries = Country::all();
        // fetch species for each country
        foreach ($countries as $country) {
            // Bypass countries that have finished syncing
            // if (in_array($country->code, ['BN'])) continue;

            $allSpecies = $this->getAllSpecies($country->code);
            foreach ($allSpecies as $species) {
                if (in_array($species->category, ['CR', 'EN', 'VU'])) {
                    $s = Species::where('taxon_id', $species->taxonid)->first();

                    // if species did not exist, create new species
                    if ($s == null) {
                        $getSpecies = $this->getSpecies($species->taxonid);
                        if ($getSpecies[0]['kingdom'] == 'ANIMALIA' && in_array($getSpecies[0]['category'], ['CR', 'EN', 'VU'])) {
                            $s = new Species;
                            $s->taxon_id = $species->taxonid;
                            $s->common_name = $getSpecies[0]['main_common_name'];
                            $s->scientific_name = $getSpecies[0]['scientific_name'];
                            $s->class = $getSpecies[0]['class'];
                            $s->category = $getSpecies[0]['category'];

                            $narrative = $this->getSpeciesNarrative($species->taxonid);
                            if ($narrative[0]['populationtrend']) {
                                $s->population_trend = $narrative[0]['populationtrend'];
                            } else {
                                $s->population_trend = 'unknown';
                            }
                            $s->save();
                        } else {
                            continue;
                        }
                    }

                    // sync countries
                    if (!$s->countries->contains($country->id)) {
                        $s->countries()->attach($country);
                    }

                    // sync threats
                    $speciesThreats = $this->getSpeciesThreats($species->taxonid);
                    $prevcode = '';
                    foreach ($speciesThreats as $st) {
                        if ($st['code'] !== $prevcode) {
                            $codes = explode(".", $st['code']);
                            $parentThreat = Threat::where('order', $codes[0])->whereNull('parent_id')->first();
                            $threat = null;
                            foreach ($parentThreat->getAllChilds() as $firstchild) {
                                if ($firstchild->code == $st['code']) {
                                    $threat = $firstchild;
                                    break;
                                }
                                foreach ($firstchild->getAllChilds() as $secondchild) {
                                    if ($secondchild->code == $st['code']) {
                                        $threat = $secondchild;
                                        break;
                                    }
                                }
                                if ($threat) {
                                    break;
                                }
                            }
                            if ($threat) {
                                if ($s->threats->contains($threat->id) == null) {
                                    $s->threats()->attach($threat);
                                }
                            }
                            $prevcode = $st['code'];
                            $s->save();
                        }
                    }
                }
            }
        }
    }

    /**
     * Construct URL
     *
     * @return string
     */
    private function constructURL($base, $param, $token)
    {
        return $base . $param . "?token=" . $token;
    }

    /**
     * Retrieve all species ID in specified country.
     *
     * @return mixed
     */
    private function getAllSpecies($country)
    {
        $url = $this->constructURL(self::API_SPECIES_BY_COUNTRY, $country, self::TOKEN);

        $client = new Client(['base_uri' => self::BASE_URL]);
        $res = $client->request('GET', $url);

        $response = json_decode($res->getBody())->result;
        $this->info("Fetching all species in " . $country);

        return $response;
    }

    /**
     * Retrieve species.
     *
     * @return mixed
     */
    private function getSpecies($speciesId)
    {
        $url = $this->constructURL(self::API_SPECIES_BY_ID, $speciesId, self::TOKEN);

        $client = new Client(['base_uri' => self::BASE_URL]);
        $res = $client->request('GET', $url);

        $response = json_decode($res->getBody(), true)['result'];
        return $response;
    }

    /**
     * Retrieve narrative of species.
     *
     * @return mixed
     */
    private function getSpeciesNarrative($speciesId)
    {
        $url = $this->constructURL(self::API_NARRATIVE_BY_SPECIES_ID, $speciesId, self::TOKEN);

        $client = new Client(['base_uri' => self::BASE_URL]);
        $res = $client->request('GET', $url);

        $response = json_decode($res->getBody(), true)['result'];
        return $response;
    }

    /**
     * Retrieve all threats of species.
     *
     * @return mixed
     */
    private function getSpeciesThreats($speciesId)
    {
        $url = $this->constructURL(self::API_THREATS_BY_SPECIES_ID, $speciesId, self::TOKEN);

        $client = new Client(['base_uri' => self::BASE_URL]);
        $res = $client->request('GET', $url);

        $response = json_decode($res->getBody(), true)['result'];
        return $response;
    }
}
