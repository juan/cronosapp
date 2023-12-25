<?php

namespace App\Http\Livewire\Config;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Arr;
use Livewire\Component;

class ConfMenus extends Component
{
    public $isdisabled;

    public $actiquery;

    public $menuspefil
        = [
            'role_id' => '',
            'menu_id' => [],
        ];

    protected $listeners = ['showMenuRoleInfo'];

    public function render()
    {

        return view('livewire.config.conf-menus', [
            'listRoles' => Role::listRoles(null, null)->get(),
            'listMenus' => Menu::has('menus', '>', 0)
                ->withcount('menus')
                ->with('optionmenus',
                    fn ($query) => $query->orderBy('menus.menu_id')
                        ->orderBy('menus.numcolum'))
                ->orderBy('numcolum')->get(),
        ])
            ->extends('layouts.app', ['title' => 'Acceso'])
            ->section('workspace');
    }

    public function getMenus()
    {
        empty($this->actiquery)
            ? $this->menusCreate()
            :
            $this->menusUpdate();
    }

    public function menusCreate()
    {
        app('userconfig')->validMenus($this->menuspefil);

        for ($i = 0; $i < count($this->menuspefil['menu_id']); $i++) {
            [$arrayheader[], $arraytitle[], $arrayopcion[]] = explode('|',
                $this->menuspefil['menu_id'][$i]);
        }

        $arraytitle = removeValueArray($arraytitle, 0);

        $opcionmenus = cleanArray(Arr::collapse([
            $arrayheader, $arraytitle, $arrayopcion,
        ]));

        app('userconfig')->menusCreate(
            $opcionmenus,
            $this->menuspefil['role_id'],
            $this->menuspefil['menu_id']
        );

    }

    public function menusUpdate()
    {
        $this->menusCreate();
    }

    public function listMenus()
    {
        $this->emit('openModal', ['moduloname' => 'config.list-menus']);
    }

    public function showMenuRoleInfo($idrole, $actiquery)
    {
        $this->actiquery = $actiquery;
        $actiquery == 'view' ? $this->isdisabled = 'disabled'
            : $this->isdisabled = null;
        $menusare
            = app('userconfig')->RoleMenuInfo($idrole)->withPivot('menu_option')
                ->first();
        if (! is_null($menusare)) {
            $menusare = unserialize($menusare->pivot['menu_option']);
        } else {
            $this->cleanForm();
            $menusare = $this->menuspefil['menu_id'];
        }

        $this->menuspefil = [
            'role_id' => $idrole,
            'menu_id' => $menusare,
        ];
    }

    public function cleanForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
}
