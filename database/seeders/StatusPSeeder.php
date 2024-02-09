<?php

namespace Database\Seeders;

use App\Models\StatusPedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = array("Nuevo", "Verificado", 'Procesado', 'Eliminado');

        foreach ($status as $key => $itrem) {
            StatusPedido::create([
                'name' => $itrem,
                'color' => '#d6e',
                'orden' => ($key + 1)
            ]);
        }
    }
}