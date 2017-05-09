<?php
namespace Paystack\Cards\Test\Mock;

use Paystack\Cards\Transport\Request;

class RequestDouble extends Request
{
    public function superSendRequest($request)
    {
        return parent::sendRequest($request);
    }

    protected function sendRequest($request)
    {
        if (!isset($this->mock)) {
            return $this->defaultResponse();
        }
        switch ($this->mock) {
            case 'requerytillfalse':
            case 'requerytillgiveup':
                return ResponseMocker::build('{"status":"requery","message":"Transaction Error"}');
                break;

            case 'false':
                return ResponseMocker::build(false, ["Bad Request"]);
                break;

            default:
                return $this->defaultResponse();
                break;
        }
    }

    protected function defaultResponse()
    {
        return ResponseMocker::build(false, ["No request to mock"]);
    }
}
