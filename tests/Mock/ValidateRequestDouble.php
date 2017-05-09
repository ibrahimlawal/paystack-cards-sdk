<?php
namespace Paystack\Cards\Test\Mock;

use Paystack\Cards\Transport\ValidateRequest;
use Paystack\Cards\Transport\Handler;

class ValidateRequestDouble extends ValidateRequest
{
    public function sendRequest($request)
    {
        if ($this->type==='phone') {
            return ResponseMocker::build('{"status":"0","auth":"otp","message":"Waiting for OTP","otpmessage":"Enter the OTP code 123456 to get a successful transaction"}');
        }
        if ($this->token==='123456') {
            return ResponseMocker::build('{"redirecturl":"?trxref=blah","trans":"'.$this->trans.'","trxref":"blah","reference":"blah","status":"success","message":"Success","response":"Approved"}');
        }
        if ($this->token==='012345') {
            return ResponseMocker::build('{"status":"0","auth":"3DS","message":"Waiting for OTP","otpmessage":"https:\/\/paystack.co\/blah"}');
        }
        if ($this->token==='901234') {
            return ResponseMocker::build('{"status":"timeout","message":"Oooops, your payment has exceeded the time to pay."}');
        }
        return ResponseMocker::build('{"status":"0","auth":"none","message":"Transaction Error"}');
    }
}
