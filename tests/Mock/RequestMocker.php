<?php

namespace Paystack\Cards\Test\Mock;

class RequestMocker
{
    public function send()
    {
        return json_decode('{}');
    }
}
