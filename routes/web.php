<?php

use App\Http\Controllers\Auth\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dahboard
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');
});

//Registro
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_empresa', App\Http\Livewire\Registro\Empresa::class)
        ->name('re_empresa');
    Route::get('/re_espe', App\Http\Livewire\Registro\Especialidad::class)
        ->name('re_espe');
    Route::get('/re_presta', App\Http\Livewire\Registro\Obrasocial::class)
        ->name('re_presta');

});

//Principal
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/re_paciente', App\Http\Livewire\Principal\RegPaciente::class)
        ->name('re_paciente');
    Route::get('/re_medico', App\Http\Livewire\Principal\RegMedico::class)
        ->name('re_medico');
    Route::get('/re_user', App\Http\Livewire\Principal\RegUsuario::class)
        ->name('re_user');

});

//Config
Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/conf_actions', App\Http\Livewire\Config\ConfPermisos::class)
        ->name('conf_actions');
    Route::get('/conf_menus', App\Http\Livewire\Config\ConfMenus::class)
        ->name('conf_menus');
    Route::get('/conf_roles', App\Http\Livewire\Config\ConfRoles::class)
        ->name('conf_roles');
});

// UI
Route::prefix('ui')->group(function () {

    // Form
    Route::prefix('form')->group(function () {
        Route::get('/components', function () {
            return view('form-components');
        });
        Route::get('/input-groups', function () {
            return view('form-input-groups');
        });
        Route::get('/layout', function () {
            return view('form-layout');
        });
        Route::get('/validations', function () {
            return view('form-validations');
        });
        Route::get('/wizards', function () {
            return view('form-wizards');
        });
    });

});

// Blank
Route::get('/blank', function () {
    return view('blank');
});

require __DIR__.'/auth.php';
