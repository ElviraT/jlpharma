<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country_default = Country::where('name', 'Venezuela')->first();
        $estado_default = State::where('name', 'Lara')->first();

        $ciudades= [
              "01" =>  "Aguada Grande",
              "02" =>  "Atarigua",
              "03" => "Barquisimeto",
              "04" => "Bobare",
              "05" => "Cabudare",
              "06" => "Carora",
              "07" => "Cubiro",
              "08" => "Cují",
              "09" => "Duaca",
              "10" =>"El Manzano",
              "11" =>"El Tocuyo",
              "12" =>"Guaríco",
              "13" =>"Humocaro Alto",
              "14" =>"Humocaro Bajo",
              "15" =>"La Miel",
              "16" =>"Moroturo",
              "17" =>"Quíbor",
              "18" => "Río Claro",
              "19" =>"Sanare",
              "20" =>"Santa Inés",
              "21" =>"Sarare",
              "22" =>"Siquisique",
              "23" =>"Tintorero"
        ];
        foreach ($ciudades as $code => $ciudad) {
            City::updateOrCreate(
                    [
                    'idCountry' => $country_default->id,
                    'idState' => $estado_default->id,
                    'name' => $ciudad,
                    'status' => 1
                    ]
            );
    }
    }
}