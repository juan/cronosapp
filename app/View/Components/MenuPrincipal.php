<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuPrincipal extends Component
{
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        $useridRole
            = auth()->user()->roles()->first()->id;

        $opcionmenu = Menu::withWhereHas('roles',
            fn ($query) => $query->where('id', $useridRole))->orderBy('numcolum')
            ->get();

        /*Menu::whereNull('menu_id')->orderBy('numcolum')
        ->withCount('optionmenus')
        ->with('optionmenus')
        ->withWhereHas('roles', fn ($query) => $query->where('id', $useridRole))
        ->get();*/

        return view('components.menu-principal', compact('opcionmenu'));
    }
}
