<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['name_action', 'sp_action'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function scopeListActions($query, array $arrayaction = null)
    {
        return $query->orderBy('sp_action')
            ->where(function ($query) use ($arrayaction) {
                if (! is_null($arrayaction)) {
                    $query->whereIn('id', $arrayaction);
                }
            });
    }

    protected function nameAction(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function spAction(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
