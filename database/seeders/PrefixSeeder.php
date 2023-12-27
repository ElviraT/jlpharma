<?php

namespace Database\Seeders;

use App\Models\Prefix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $prefixes = array("V-", "E-", "J-");

        foreach ($prefixes as $prefix) {
            Prefix::create([
                'name' => $prefix,
            ]);
        }
    }
}
