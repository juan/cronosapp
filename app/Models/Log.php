<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable
        = [
            'user_id', 'query_id', 'modelclass_type', 'modelclass_id',
            'form_name', 'message', 'querymessage', 'device_type',
            'browser_type', 'opsys_type', 'ip', 'browser_version',
        ];

    public function modelclass()
    {
        return $this->morphTo();
    }
}
