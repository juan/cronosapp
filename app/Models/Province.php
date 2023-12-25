<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['province_name'];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function scopeListProvince($query, $strintofind = null)
    {

        return $query->when($strintofind ?? null,
            function ($query) use ($strintofind) {
                $query->where(function ($query) use ($strintofind) {
                    $query->where('province_name', 'LIKE',
                        '%'.strtoupper($strintofind).'%');
                })->orderBy('province_name');

            });
    }

    protected function provinceName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper($value),
        );
    }
}
