<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['province_id', 'city_name'];

    public function scopeListCity($query, $paramtofind, $provinceid = false)
    {
        return $query->when($paramtofind ?? null or $provinceid ?? null,
            function ($query) use ($paramtofind, $provinceid) {
                $query->where(function ($query) use (
                    $paramtofind,
                    $provinceid
                ) {
                    $query->where('city_name', 'LIKE',
                        '%'.strtoupper($paramtofind).'%')
                        ->where('province_id', $provinceid);
                });

            })->orderBy('city_name');
    }

    protected function cityName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper($value),
        );
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
