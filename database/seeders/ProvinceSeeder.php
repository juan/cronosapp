<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $province = [
            ['province_name' => 'Buenos Aires'],
            ['province_name' => 'Ciudad Autónoma de Buenos Aires'],
            ['province_name' => 'Catamarca'],
            ['province_name' => 'Chaco'],
            ['province_name' => 'Chubut'],
            ['province_name' => 'Córdoba'],
            ['province_name' => 'Corrientes'],
            ['province_name' => 'Entre Ríos'],
            ['province_name' => 'Formosa'],
            ['province_name' => 'Jujuy'],
            ['province_name' => 'La Pampa'],
            ['province_name' => 'La Rioja'],
            ['province_name' => 'Mendoza'],
            ['province_name' => 'Misiones'],
            ['province_name' => 'Neuquén'],
            ['province_name' => 'Río Negro'],
            ['province_name' => 'Salta'],
            ['province_name' => 'San Juan'],
            ['province_name' => 'San Luis'],
            ['province_name' => 'Santa Cruz'],
            ['province_name' => 'Santa Fe'],
            ['province_name' => 'Santiago del Estero'],
            ['province_name' => 'Tierra del Fuego'],
            ['province_name' => 'Tucumán'],
        ];
        foreach ($province as $dataprove) {
            Province::create($dataprove);
        }
    }
}
