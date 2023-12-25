<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Identity extends Model
{
    protected $fillable
        = [
            'name_identity',
        ];

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    protected function nameIdentity(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
