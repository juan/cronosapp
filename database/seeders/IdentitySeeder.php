<?php

namespace Database\Seeders;

use App\Models\Identity;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    public function run(): void
    {
        $identity = [
            ['name_identity' => 'DNI'],
            ['name_identity' => 'PAS'],

        ];
        foreach ($identity as $dataiden) {
            Identity::create($dataiden);
        }
    }
}
