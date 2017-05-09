<?php

namespace Paystack\Cards\Test\Exception;

use Paystack\Cards\Exception\IncompleteCardDetailsException;

class IncompleteAccessCodeExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $e = new IncompleteCardDetailsException('message');
        $this->assertNotNull($e);
    }
}
