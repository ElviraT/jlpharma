<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = array("Activo", "Inactivo", "Pendiente");

        foreach ($prefixes as $prefix) {
            Status::create([
                'name' => $prefix,
                'color' => '#d6e1ea',
            ]);
        }
    }
}
