<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use RecordsActivity;

    protected $fillable
        = [
            'name_accion',
        ];
}
