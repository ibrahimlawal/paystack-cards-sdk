<?php

namespace Paystack\Cards\Test\Exception;

use Paystack\Cards\Exception\EncryptionException;

class EncryptionExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $e = new EncryptionException('message');
        $this->assertNotNull($e);
    }
}
