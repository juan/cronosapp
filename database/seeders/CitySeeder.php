<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = [
            ['province_id' => '15', 'city_name' => 'Alumine'],
            ['province_id' => '15', 'city_name' => 'Andacollo'],
            ['province_id' => '15', 'city_name' => 'Arroyito'],
            ['province_id' => '15', 'city_name' => 'Caviahue'],
            ['province_id' => '15', 'city_name' => 'Centenario'],
            ['province_id' => '15', 'city_name' => 'Chos Malal'],
            ['province_id' => '15', 'city_name' => 'Copahue'],
            ['province_id' => '15', 'city_name' => 'Cutral Co'],
            ['province_id' => '15', 'city_name' => 'El Cholar'],
            ['province_id' => '15', 'city_name' => 'El Huecu'],
            ['province_id' => '15', 'city_name' => 'Huinganco'],
            ['province_id' => '15', 'city_name' => 'Junin de los Andes'],
            ['province_id' => '15', 'city_name' => 'Las Lajas'],
            ['province_id' => '15', 'city_name' => 'Las Ovejas'],
            ['province_id' => '15', 'city_name' => 'Loncopue'],
            ['province_id' => '15', 'city_name' => 'Manzano Amargo'],
            ['province_id' => '15', 'city_name' => 'Moquehue'],
            ['province_id' => '15', 'city_name' => 'Neuquen Capital'],
            ['province_id' => '15', 'city_name' => 'Picun Leufu'],
            ['province_id' => '15', 'city_name' => 'Piedra del Aguila'],
            ['province_id' => '15', 'city_name' => 'Plaza Huincul'],
            ['province_id' => '15', 'city_name' => 'Plottier'],
            ['province_id' => '15', 'city_name' => 'Primeros Pinos'],
            ['province_id' => '15', 'city_name' => 'Pulmari'],
            ['province_id' => '15', 'city_name' => 'Rincón de los Sauces'],
            ['province_id' => '15', 'city_name' => 'San Martin de los Andes'],
            ['province_id' => '15', 'city_name' => 'Tricao Malal'],
            ['province_id' => '15', 'city_name' => 'Varvarco'],
            ['province_id' => '15', 'city_name' => 'Villa El Chocon'],
            ['province_id' => '15', 'city_name' => 'Villa La Angostura'],
            ['province_id' => '15', 'city_name' => 'Villa Lago Meliquina'],
            ['province_id' => '15', 'city_name' => 'Villa Pehuenia'],
            ['province_id' => '15', 'city_name' => 'Villa Traful'],
            ['province_id' => '15', 'city_name' => 'Zapala'],
            ['province_id' => '16', 'city_name' => 'Allen'],
            ['province_id' => '16', 'city_name' => 'Bariloche'],
            ['province_id' => '16', 'city_name' => 'Catriel'],
            ['province_id' => '16', 'city_name' => 'Choele Choel'],
            ['province_id' => '16', 'city_name' => 'Cinco Saltos'],
            ['province_id' => '16', 'city_name' => 'Cipolletti'],
            ['province_id' => '16', 'city_name' => 'Dina Huapi'],
            ['province_id' => '16', 'city_name' => 'El Bolson'],
            ['province_id' => '16', 'city_name' => 'El Manso'],
            ['province_id' => '16', 'city_name' => 'General Conesa'],
            ['province_id' => '16', 'city_name' => 'General Roca'],
            ['province_id' => '16', 'city_name' => 'Ingeniero Jacobacci'],
            ['province_id' => '16', 'city_name' => 'Las Grutas'],
            ['province_id' => '16', 'city_name' => 'Los Menucos'],
            ['province_id' => '16', 'city_name' => 'Ministro Ramos Mexia'],
            ['province_id' => '16', 'city_name' => 'Playas Doradas'],
            ['province_id' => '16', 'city_name' => 'Rio Colorado'],
            ['province_id' => '16', 'city_name' => 'San Antonio Este'],
            ['province_id' => '16', 'city_name' => 'San Antonio Oeste'],
            ['province_id' => '16', 'city_name' => 'Sierra Colorada'],
            ['province_id' => '16', 'city_name' => 'Sierra Grande'],
            ['province_id' => '16', 'city_name' => 'Valcheta'],
            ['province_id' => '16', 'city_name' => 'Viedma'],
            ['province_id' => '16', 'city_name' => 'Villa El Condor'],
            ['province_id' => '16', 'city_name' => 'Villa Lago Gutiérrez'],
            ['province_id' => '16', 'city_name' => 'Villa Lago Mascardi'],
            ['province_id' => '16', 'city_name' => 'Villa Regina'],
        ];
        foreach ($city as $dataciy) {
            City::create($dataciy);
        }
    }
}
