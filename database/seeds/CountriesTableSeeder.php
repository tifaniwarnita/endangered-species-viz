<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        DB::table('countries')->insert([
        [
            'code' => 'BN',
            'name' => 'Brunie Darussalam',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'KH',
            'name' => 'Cambodia',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'TL',
            'name' => 'Timor Leste',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'ID',
            'name' => 'Indonesia',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'LA',
            'name' => 'Laos',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'MY',
            'name' => 'Malaysia',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'MM',
            'name' => 'Myanmar',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'PH',
            'name' => 'Philippines',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'SG',
            'name' => 'Singapore',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'TH',
            'name' => 'Thailand',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ],
        [
            'code' => 'VN',
            'name' => 'Vietnam',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]]);
    }
}
