<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable
        = [
            'name_skill',
        ];

    public function scopeListSkill(Builder $query): Builder
    {
        return $query->orderBy('name_skill');
    }

    protected function nameSkill(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->ucfirst(str()->lower($value)),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
