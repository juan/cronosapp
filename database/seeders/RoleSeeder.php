<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name_role' => 'Owner',
            ],
            [
                'name_role' => 'Administrador',
            ],
            [
                'name_role' => 'Auditor',
            ],
            [
                'name_role' => 'Operador',
            ],
            [
                'name_role' => 'Médico',
            ],
            [
                'name_role' => 'Finanzas',
            ],
        ];

        foreach ($roles as $dataroles) {
            Role::create($dataroles);
        }
    }
}
