<?php

namespace App\Helpers\ApiHelper;


use Illuminate\Support\Facades\Lang;

class Result
{
    public $isOk = true;
    public $message = 'Task Complete';
    public $result;

    public function __construct($result = null, string $message = '', bool $isOk = true)
    {
        $this->isOk = $isOk;
        $this->message = empty($message) ? Lang::get('Messages.TaskCompleteSuccessfully') : $message;
        $this->result = $result;
    }

}
