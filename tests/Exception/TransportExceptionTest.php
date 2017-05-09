<?php

namespace Paystack\Cards\Test\Exception;

use Paystack\Cards\Exception\TransportException;

class TransportExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $e = new TransportException('message');
        $this->assertNotNull($e);
    }
}
