<?php

namespace Paystack\Cards\Test\Mock;

use Paystack\Cards\Transport\ValidateRequest;

class ValidateRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $e = new ValidateRequest(null, null, null);
    }
}
