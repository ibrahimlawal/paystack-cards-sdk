<?php
namespace Paystack\Cards\Test\Mock;

use Paystack\Cards\Transport\Handler;

class HandlerDouble extends Handler
{
    protected $requery_delay = 0;
    protected $mode;

    protected function requestClass()
    {
        return 'Paystack\Cards\Test\Mock\RequestDouble';
    }

    public function superRequestClass()
    {
        return parent::requestClass();
    }

    protected function postPrepRequeryRequest($request)
    {
        parent::postPrepRequeryRequest($request);
        switch ($this->mode) {
            case '1':
                $request->mock = 'requerytillgiveup';
                break;
            case '2':
                $request->mock = ($this->requeries < 3) ? 'requerytillfalse' : 'false';
                break;


            default:
                # code...
                break;
        }
    }

    public function publiclyHandle($trans, $response)
    {
        $this->mode = $trans;
        return $this->handle($trans, $response);
    }
}
