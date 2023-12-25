<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsuranceType extends Model
{
    use HasFactory, TableSorting, RecordsActivity;

    protected $fillable = ['name_type'];

    protected $columSortName = 'name_type';

    public function scopeListTypeInsurance(
        $query,
        array $list = null,
        string $searcterm = null
    ) {
        if ($list == null) {
            return $query->orWhere('name_type', 'like',
                '%'.str()->upper($searcterm).'%')->orderBy('name_type');
        } else {
            return $query->whereIn('id', $list)->orderBy('name_type');
        }
    }

    public function insurances(): HasMany
    {
        return $this->hasMany(Insurance::class)->orderBy('name_insurance');
    }

    protected function nameType(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
