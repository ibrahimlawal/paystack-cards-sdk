<?php

namespace Paystack\Cards\Test\Mock;

class ResponseMocker
{
    public $mock;
    public $messages;

    public static function build($value, $messages = [])
    {
        $m = new ResponseMocker();
        $m->mock = $value;
        $m->messages = [];
        return $m;
    }

    public function wrapUp()
    {
        if (!isset($this->mock)) {
            return false;
        }
        return $this->mock;
    }
}
