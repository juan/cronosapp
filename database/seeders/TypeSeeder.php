<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $typeseeder = [
            ['matricula_type' => 'MP'],
            ['matricula_type' => 'MN'],
        ];

        foreach ($typeseeder as $datatye) {
            Type::create($datatye);
        }
    }
}
