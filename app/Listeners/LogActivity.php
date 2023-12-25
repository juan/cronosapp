<?php

namespace App\Listeners;

use App\Models\Income;
use App\Traits\LogConfig;
use Illuminate\Auth\Events as LaravelEvents;

class LogActivity
{
    use LogConfig;

    public function login(LaravelEvents\Login $event)
    {

        $incomes = Income::create(['name_accion' => 'Ingresado']);
    }

    public function logout(LaravelEvents\Logout $event)
    {
        Income::create(['name_accion' => 'Salido']);
    }
}
