<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['state_name'];

    public function scopeListStates($query, array $list = null)
    {
        if ($list == null) {
            return $query->orderBy('state_name');
        } else {
            return $query->whereIn('id', $list)->orderBy('state_name');
        }

    }

    protected function stateName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => str()->upper($value),
            set: fn ($value) => str()->upper(str()->squish($value)),
        );
    }
}
