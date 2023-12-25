<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsurancePlan extends Model
{
    use RecordsActivity, TableSorting;

    protected $columSortName = 'name_insplan';

    protected $fillable
        = [
            'insurance_id',
            'state_id',
            'name_insplan',
            'descrip_insplan',
        ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function insurance(): BelongsTo
    {
        return $this->belongsTo(Insurance::class);
    }

    public function scopeTableQuery($query, $idInsurance)
    {
        return $query->where('insurance_id', $idInsurance)
            ->with(['state', 'insurance']);
    }

    public function findMe($string, $columid)
    {
        return $this->where('name_insplan', 'like',
            '%'.str()->upper($string).'%')
            ->where('insurance_id', $columid)
            ->orderBy('name_insplan');
    }

    protected function nameInsplan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }

    protected function descripInsplan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
