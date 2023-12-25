<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $gender = [
            ['name_gender' => 's/i'],
            ['name_gender' => 'femenino'],
            ['name_gender' => 'masculino'],
        ];

        foreach ($gender as $datagen) {
            Gender::create($datagen);
        }
    }
}
