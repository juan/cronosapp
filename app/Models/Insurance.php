<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Insurance extends Model
{
    use RecordsActivity, TableSorting;

    protected $fillable
        = [
            'insurance_type_id', 'state_id', 'name_insurance', 'telefono',
            'correo',
        ];

    protected $columSortName = 'name_insurance';

    public function scopeTableQuery($query)
    {
        return $query->with(['insurance_type', 'state'])
            ->withCount('insuranceplans');
    }

    public function insurance_type(): BelongsTo
    {
        return $this->belongsTo(InsuranceType::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function insuranceplans(): HasMany
    {
        return $this->hasMany(InsurancePlan::class)->orderBy('name_insplan');
    }

    public function findMe($string, $columid = null)
    {
        return $this->where('name_insurance', 'like',
            '%'.str()->upper($string).'%')
            ->where('insurance_type_id', $columid)
            ->orderBy('name_insurance');
    }

    protected function nameInsurance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function correo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->lower($value),
            set: fn ($value) => str()->lower(str()->squish($value)),
        );
    }
}
