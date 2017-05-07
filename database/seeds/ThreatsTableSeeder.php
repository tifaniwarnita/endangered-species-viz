<?php

use Illuminate\Database\Seeder;

class ThreatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('threats')->delete();

        // Root Threats
        DB::table('threats')->insert([
        [
            'parent_id' => null,
            'name' => 'Residential & commercial development',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Agriculture & aquaculture',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Energy production & mining',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Transportation & service corridors',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Biological resource use',
            'order' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Human intrusions & disturbance',
            'order' => 6,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Natural system modifications',
            'order' => 7,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Invasive & other problematic species, genes & diseases',
            'order' => 8,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Pollution',
            'order' => 9,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Geological events',
            'order' => 10,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Climate change & severe weather',
            'order' => 11,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => null,
            'name' => 'Other options',
            'order' => 12,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 1
        $threatId = DB::table('threats')->where('name', 'Residential & commercial development')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Housing & urban areas',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Commercial & industrial areas',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Tourism & recreation areas',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 2
        $threatId = DB::table('threats')->where('name', 'Agriculture & aquaculture')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Annual & perennial non-timber crops',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Wood & pulp plantations',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Livestock farming & ranching',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Marine & freshwater aquaculture',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 2.1
        $threatId = DB::table('threats')->where('name', 'Annual & perennial non-timber crops')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Shifting agriculture',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Small-holder farming',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Agro-industry farming',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Scale Unknown/Unrecorded',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 2.2
        $threatId = DB::table('threats')->where('name', 'Wood & pulp plantations')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Small-holder plantations',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Agro-industry plantations',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Scale Unknown/Unrecorded',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 2.3
        $threatId = DB::table('threats')->where('name', 'Livestock farming & ranching')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Nomadic grazing',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Small-holder grazing, ranching or farming',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Agro-industry grazing, ranching or farming',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Scale Unknown/Unrecorded',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 2.4
        $threatId = DB::table('threats')->where('name', 'Marine & freshwater aquaculture')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Subsistence/artisinal aquaculture',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Industrial aquaculture',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Scale Unknown/Unrecorded',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 3
        $threatId = DB::table('threats')->where('name', 'Energy production & mining')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Oil & gas drilling',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Mining & quarrying',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Renewable energy',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 4
        $threatId = DB::table('threats')->where('name', 'Transportation & service corridors')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Roads & railroads',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Utility & service lines',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Shipping lanes',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Flight paths',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 5
        $threatId = DB::table('threats')->where('name', 'Biological resource use')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Hunting & collecting terrestrial animals',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Gathering terrestrial plants',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Logging & wood harvesting',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Fishing & harvesting aquatic resources',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 5.1
        $threatId = DB::table('threats')->where('name', 'Hunting & collecting terrestrial animals')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Intentional use (species being assessed is the target)',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Unintentional effects (species being assessed is not the target)',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Persecution/control',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Motivation Unknown/Unrecorded',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 5.2
        $threatId = DB::table('threats')->where('name', 'Gathering terrestrial plants')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Intentional use (species being assessed is the target)',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Unintentional effects (species being assessed is not the target)',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Persecution/control',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Motivation Unknown/Unrecorded',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 5.3
        $threatId = DB::table('threats')->where('name', 'Logging & wood harvesting')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Intentional use: subsistence/small scale (species being assessed is the target) [harvest]',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Intentional use: large scale (species being assessed is the target) [harvest]',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Unintentional effects: subsistence/small scale (species being assessed is not the target) [harvest]',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Unintentional effects: large scale (species being assessed is not the target) [harvest]',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Motivation Unknown/Unrecorded',
            'order' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 5.4
        $threatId = DB::table('threats')->where('name', 'Fishing & harvesting aquatic resources')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Intentional use: subsistence/small scale (species being assessed is the target) [harvest]',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Intentional use: large scale (species being assessed is the target) [harvest]',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Unintentional effects: subsistence/small scale (species being assessed is not the target) [harvest]',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Unintentional effects: large scale (species being assessed is not the target) [harvest]',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Persecution/control',
            'order' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Motivation Unknown/Unrecorded',
            'order' => 6,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 6
        $threatId = DB::table('threats')->where('name', 'Human intrusions & disturbance')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Recreational activities',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'War, civil unrest & military exercises',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Work & other activities',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 7
        $threatId = DB::table('threats')->where('name', 'Natural system modifications')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Fire & fire suppression',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Dams & water management/use',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Other ecosystem modifications',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 7.1
        $threatId = DB::table('threats')->where('name', 'Fire & fire suppression')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Increase in fire frequency/intensity',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Suppression in fire frequency/intensity',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Trend Unknown/Unrecorded',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 7.2
        $threatId = DB::table('threats')->where('name', 'Dams & water management/use')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of surface water (domestic use)',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of surface water (commercial use)',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of surface water (agricultural use)',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of surface water (unknown use)',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of ground water (domestic use)',
            'order' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of ground water (commercial use)',
            'order' => 6,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of ground water (agricultural use)',
            'order' => 7,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Abstraction of ground water (unknown use)',
            'order' => 8,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Small dams',
            'order' => 9,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Large dams',
            'order' => 10,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Dams (size unknown)',
            'order' => 11,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 8
        $threatId = DB::table('threats')->where('name', 'Invasive & other problematic species, genes & diseases')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Invasive non-native/alien species/diseases',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Problematic native species/diseases',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Introduced genetic material',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Problematic species/diseases of unknown origin',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Viral/prion-induced diseases',
            'order' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Diseases of unknown cause',
            'order' => 6,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 8.1
        $threatId = DB::table('threats')->where('name', 'Invasive non-native/alien species/diseases')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Unspecified species',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Named species',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 8.2
        $threatId = DB::table('threats')->where('name', 'Problematic native species/diseases')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Unspecified species',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Named species',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 8.4
        $threatId = DB::table('threats')->where('name', 'Problematic species/diseases of unknown origin')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Unspecified species',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Named species',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 8.5
        $threatId = DB::table('threats')->where('name', 'Viral/prion-induced diseases')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Unspecified "species" (disease)',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Named "species" (disease)',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 9
        $threatId = DB::table('threats')->where('name', 'Pollution')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Domestic & urban waste water',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Industrial & military effluents',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Agricultural & forestry effluents',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Garbage & solid waste',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Air-borne pollutants',
            'order' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Excess energy',
            'order' => 6,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 9.1
        $threatId = DB::table('threats')->where('name', 'Domestic & urban waste water')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Sewage',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Run-off',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Trend Unknown/Unrecorded',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 9.2
        $threatId = DB::table('threats')->where('name', 'Industrial & military effluents')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Oil spills',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Seepage from mining',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Trend Unknown/Unrecorded',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 9.3
        $threatId = DB::table('threats')->where('name', 'Agricultural & forestry effluents')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Nutrient loads',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Soil erosion, sedimentation',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Herbicides and pesticides',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Type Unknown/Unrecorded',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 9.5
        $threatId = DB::table('threats')->where('name', 'Air-borne pollutants')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Acid rain',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Smog',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Ozone',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Type Unknown/Unrecorded',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // 9.6
        $threatId = DB::table('threats')->where('name', 'Excess energy')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Light pollution',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Thermal pollution',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Noise pollution',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Type Unknown/Unrecorded',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 10
        $threatId = DB::table('threats')->where('name', 'Geological events')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Volcanoes',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Earthquakes/tsunamis',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Avalanches/landslides',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 11
        $threatId = DB::table('threats')->where('name', 'Climate change & severe weather')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Habitat shifting & alteration',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Droughts',
            'order' => 2,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Temperature extremes',
            'order' => 3,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Storms & flooding',
            'order' => 4,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'parent_id' => $threatId,
            'name' => 'Other impacts',
            'order' => 5,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);

        // Category 12
        $threatId = DB::table('threats')->where('name', 'Other options')->first()->id;

        DB::table('threats')->insert([
        [
            'parent_id' => $threatId,
            'name' => 'Other threat',
            'order' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);
    }
}
