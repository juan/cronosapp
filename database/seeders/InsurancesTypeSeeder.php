<?php

namespace Database\Seeders;

use App\Models\InsuranceType;
use Illuminate\Database\Seeder;

class InsurancesTypeSeeder extends Seeder
{
    public function run(): void
    {
        $insuretype = [
            ['name_type' => 'obra social'],
            ['name_type' => 'particular'],
            ['name_type' => 'laboral'],
        ];

        foreach ($insuretype as $datinst) {
            InsuranceType::create($datinst);
        }
    }
}
