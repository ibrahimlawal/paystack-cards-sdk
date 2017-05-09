<?php
namespace Paystack\Cards\Test\Mock;

use Paystack\Cards\Transport\Request;
use Paystack\Cards\Exception\TransportException;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $e = new Request();
    }

    public function testSendRequest()
    {
        $d = new RequestDouble();
        $r = new RequestMocker();
        $o = $d->superSendRequest($r);
        $this->assertInstanceOf(\stdClass::class, $o);
    }
}
