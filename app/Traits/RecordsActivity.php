<?php

namespace App\Traits;

use App\Models\Log;
use App\Models\Query;

trait RecordsActivity
{
    use LogConfig;

    public $issave;

    public static function isCreate($model)
    {

        return $model->wasRecentlyCreated ? 'y' : 'n';

    }

    public static function isUpadate($model)
    {

        return $model->getChanges();
    }

    protected static function bootRecordsActivity()
    {
        foreach (static::getModelEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->createdLog($event);
            });
        }
    }

    protected static function getModelEvents()
    {
        return ['created', 'updated'];
    }

    protected function createdLog($event)
    {
        $classname = $this->nameclass($this);
        if ($this->formName() == 'login' or $this->formName() == 'logout') {
            $themessage = 'ha';
            $queryid = $this->formName() == 'login' ? 4 : 5;

        } else {
            $themessage = config("classlog.queryacc.$event").' '
                .config("classlog.classname.$classname");
            $queryid = Query::where('name_query', $event)->first()->id;
        }

        Log::create([
            'user_id' => auth()->id(),
            'query_id' => $queryid,
            'modelclass_type' => get_class($this),
            'modelclass_id' => $this->id,
            'ip' => $this->setIp(),
            'device_type' => $this->setDevictype(),
            'browser_type' => $this->setBrowstype(),
            'browser_version' => $this->setversionBrowser(),
            'opsys_type' => $this->setOpsystem(),
            'form_name' => $this->formName(),
            'message' => $themessage,
        ]);
    }

    protected function nameclass($theclass)
    {
        return str()->lower(substr(get_class($theclass),
            strrpos(get_class($theclass), '\\') + 1));
    }
}
