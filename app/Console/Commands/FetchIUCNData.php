<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class FetchIUCNData extends Command
{
    const BASE_URL = "http://apiv3.iucnredlist.org/api/v3/";
    const API_SPECIES_BY_COUNTRY = "country/getspecies/";
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
        // $this->getAllSpecies("ID");
        $this->getSpeciesNarrative("22694927");
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
        echo($url);

        $client = new Client(['base_uri' => self::BASE_URL]);
        $res = $client->request('GET', $url);

        $response = json_decode($res->getBody())->result;
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
        echo($url);

        $client = new Client(['base_uri' => self::BASE_URL]);
        $res = $client->request('GET', $url);

        $response = json_decode($res->getBody())->result;
        return $response;
    }

    /**
     * Retrieve all threats of species.
     *
     * @return mixed
     */
    private function getSpeciesThreats($speciesId)
    {
        $url = $this->constructURL(self::API_SPECIES_BY_COUNTRY, $speciesId, self::TOKEN);
        echo($url);

        $client = new Client(['base_uri' => self::BASE_URL]);
        $res = $client->request('GET', $url);

        $response = json_decode($res->getBody())->result;
        return $response;
    }
}
