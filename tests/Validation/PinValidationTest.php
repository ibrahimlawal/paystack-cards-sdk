<?php

namespace Paystack\Cards\Test\Validation;

use Paystack\Cards\Validation\PinValidation;

class PinValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $this->assertFalse(PinValidation::validate('123'));
        $this->assertTrue(PinValidation::validate('1234'));
        $this->assertFalse(PinValidation::validate('1ba4'));
    }
}
