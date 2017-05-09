<?php
namespace Paystack\Cards\Test\Mock;

use Paystack\Cards;
use Paystack\Cards\Transport\Handler;

use Paystack\Cards\Transport\Request;
use Paystack\Cards\Test\Mock\ChargeRequestDouble as ChargeRequest;
use Paystack\Cards\Test\Mock\ValidateRequestDouble as ValidateRequest;

class CardsTestDouble extends Cards
{
    public function __construct(
        $secret_key,
        \Closure $successCallback,
        \Closure $failedCallback,
        \Closure $pinCallback,
        \Closure $tokenCallback,
        \Closure $phoneCallback,
        \Closure $timeoutCallback,
        \Closure $threedsCallback
    ) {

        $this->api = new PaystackPhpTestDouble();
        $this->handler=new HandlerDouble(
            $successCallback,
            $failedCallback,
            $pinCallback,
            $tokenCallback,
            $phoneCallback,
            $timeoutCallback,
            $threedsCallback,
            $this->api
        );
    }

    protected function chargeRequestClass()
    {
        return 'Paystack\Cards\Test\Mock\ChargeRequestDouble';
    }

    protected function validateRequestClass()
    {
        return 'Paystack\Cards\Test\Mock\ValidateRequestDouble';
    }

    public function superChargeRequestClass()
    {
        return parent::chargeRequestClass();
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function superValidateRequestClass()
    {
        return parent::validateRequestClass();
    }
}
