<?php

namespace App\Traits;

use Jenssegers\Agent\Facades\Agent;

trait LogConfig
{
    public $myip;

    public $browstype;

    public $versbros;

    public $devictype;

    public $opsys;

    public function setversionBrowser()
    {
        return $this->versbros = Agent::version($this->setBrowstype());
    }

    public function setBrowstype()
    {
        return $this->browstype = Agent::browser();
    }

    public function setDevictype()
    {
        return $this->devictype = ((Agent::isTablet() ? 'Table'
            : Agent::isPhone()) ? 'Phone' : 'PC');
    }

    public function setOpsystem()
    {
        return $this->opsys = Agent::platform();
    }

    public function setIp()
    {
        return $this->myip = request()->ip();
    }

    public function formName()
    {
        return url()->getRequest()->path();
    }
}
