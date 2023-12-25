<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable
        = [
            'matricula_type',
        ];

    public function scopeListTypes($query, array $types)
    {

        return $query->whereIn('id', $types)->orderBy('matricula_type');

    }
}
