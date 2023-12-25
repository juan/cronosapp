<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable
        = [
            'menu_id',
            'numcolum',
            'namemenu',
            'bigicon',
            'inicial',
            'titulo',
            'linkto',
            'descripcion',
        ];

    public function menus(): HasMany
    {
        return $this->hasMany(self::class);
    }

    public function optionmenus(): HasMany
    {
        return $this->hasMany(self::class, 'menu_id', 'id')
            ->with('menus');
    }

    /**All relations for Menu**/

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    protected function namemenu(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value)
        );
    }
}
