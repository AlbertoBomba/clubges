<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['name' => 'España',       'iso_code' => 'ESP', 'phone_code' => '+34'],
            ['name' => 'Francia',     'iso_code' => 'FRA', 'phone_code' => '+33'],
            ['name' => 'Portugal',     'iso_code' => 'POR', 'phone_code' => '+351'],
        ]);
    }
}
