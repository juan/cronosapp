<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specialtie extends Model
{
    use RecordsActivity, TableSorting;

    protected $fillable
        = [
            'name_speciality',
            'state_id',
            'fecha_creada',
        ];

    protected $columSortName = 'name_speciality';

    public function scopeTableQuery($query)
    {
        return $query->with('state');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function scopeListSpeciality(Builder $query): Builder
    {
        return $query->where('state_id', 1)
            ->orderBy('name_speciality');
    }

    protected function fechaCreada(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? ''
                : date('d-m-Y', strtotime($value)),
            set: fn ($value) => str()->squish($value),
        );
    }

    protected function nameSpeciality(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
