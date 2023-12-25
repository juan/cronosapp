<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permiso = [
            [
                'name_action' => 'create',
                'sp_action' => 'crear',
            ],
            [
                'name_action' => 'update',
                'sp_action' => 'actualizar',
            ],
            [
                'name_action' => 'view',
                'sp_action' => 'vista',
            ],
            [
                'name_action' => 'delete',
                'sp_action' => 'borrar',
            ],
            [
                'name_action' => 'print',
                'sp_action' => 'imprimir',
            ],
            [
                'name_action' => 'export',
                'sp_action' => 'exportar',

            ],
            [
                'name_action' => 'import',
                'sp_action' => 'importar',
            ],
        ];

        foreach ($permiso as $datapermi) {
            Action::create($datapermi);
        }
    }
}
