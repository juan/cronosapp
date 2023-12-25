<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menuopcion = [
            [
                'numcolum' => 1,
                'namemenu' => 'Registro',
                'bigicon' => 'la la-pencil',
                'inicial' => 'rtro',
                'linkto' => '#no-link',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 2,
                'namemenu' => 'Principal',
                'bigicon' => '',
                'inicial' => 'tprincipa',
                'linkto' => '#no-link',
                'titulo' => 's',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 3,
                'namemenu' => 'Usuario',
                'bigicon' => 'la la-user',
                'inicial' => 'rguser',
                'linkto' => 're_user',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 4,
                'namemenu' => 'Médico',
                'bigicon' => 'la la-medkit',
                'inicial' => 'mico',
                'linkto' => 're_medico',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 5,
                'namemenu' => 'Servicio',
                'bigicon' => 'la la-hospital-o',
                'inicial' => 'mico',
                'linkto' => '',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 6,
                'namemenu' => 'Paciente',
                'bigicon' => 'la la-users',
                'inicial' => 'pnte',
                'linkto' => 're_paciente',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 7,
                'namemenu' => 'Operativo',
                'bigicon' => '',
                'inicial' => 'opto',
                'linkto' => '#no-link',
                'titulo' => 's',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 8,
                'namemenu' => 'Empresa',
                'bigicon' => 'la la-institution',
                'inicial' => 'eesa',
                'linkto' => 're_empresa',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 9,
                'namemenu' => 'Especialidades',
                'bigicon' => 'la la-leanpub',
                'inicial' => 'oial',
                'linkto' => 're_espe',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 10,
                'namemenu' => 'Prestadores',
                'bigicon' => 'la la-archive',
                'inicial' => 'oial',
                'linkto' => 're_presta',
                'descripcion' => '',
            ],
            [
                'menu_id' => 1,
                'numcolum' => 11,
                'namemenu' => 'Turnos',
                'bigicon' => 'la la-calendar-o',
                'inicial' => 'tnos',
                'linkto' => '',
                'descripcion' => '',
            ],
            [

                'numcolum' => 12,
                'namemenu' => 'Configuración',
                'bigicon' => 'la la-cog',
                'inicial' => 'laconf',
                'linkto' => '#no-link',
                'descripcion' => '',
            ],
            [
                'menu_id' => 12,
                'numcolum' => 13,
                'namemenu' => 'Sistema',
                'bigicon' => '',
                'inicial' => 'confsis',
                'linkto' => '#no-link',
                'titulo' => 's',
                'descripcion' => '',
            ],
            [
                'menu_id' => 12,
                'numcolum' => 14,
                'namemenu' => 'Roles',
                'bigicon' => 'la la-shield',
                'inicial' => 'conroles',
                'linkto' => '#no-link',
                'descripcion' => '',
            ],
            [
                'menu_id' => 12,
                'numcolum' => 15,
                'namemenu' => 'Permisos',
                'bigicon' => 'la la-list-alt',
                'inicial' => 'conperm',
                'linkto' => 'conf_actions',
                'descripcion' => '',
            ],
            [
                'menu_id' => 12,
                'numcolum' => 16,
                'namemenu' => 'Acceso',
                'bigicon' => 'la la-toggle-on',
                'inicial' => 'confacc',
                'linkto' => 'conf_menus',
                'descripcion' => '',
            ],
        ];
        foreach ($menuopcion as $mdata) {
            Menu::create($mdata);
        }
    }
}
