<?php

namespace App\Models;

use App\Traits\TableSorting;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model
{
    use TableSorting;

    protected $fillable
        = [
            'name_gender',
        ];

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function findMe($string)
    {
        return $this->where('name_gender', 'like',
            '%'.str()->upper($string).'%')
            ->orderBy('name_gender');
    }

    protected function nameGender(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
