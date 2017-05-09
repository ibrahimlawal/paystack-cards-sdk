<?php

namespace Paystack\Cards\Test\Exception;

use Paystack\Cards\Exception\BadAccessCodeException;

class BadAccessCodeExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $e = new BadAccessCodeException('message');
        $this->assertNotNull($e);
    }
}
