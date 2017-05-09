<?php
namespace Paystack\Cards\Test\Mock;

use Paystack\Cards\Transport\ChargeRequest;

class ChargeRequestDouble extends ChargeRequest
{
    protected function sendRequest($request)
    {
        if ($this->handle === '') {
            return ResponseMocker::build('{"status":"0","auth":"pin","message":"Please send PIN"}');
        }
        return ResponseMocker::build('{"status":"0","auth":"phone","message":"Waiting for phone","otpmessage":"Enter some random phone"}');
    }
}
