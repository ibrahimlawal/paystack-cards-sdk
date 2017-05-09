<?php

namespace Paystack\Cards\Test\Validation;

use Paystack\Cards\Validation\TokenValidation;

class TokenValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $this->assertFalse(TokenValidation::validate('123'));
        $this->assertTrue(TokenValidation::validate('1234'));
        $this->assertTrue(TokenValidation::validate('1234572863'));
        $this->assertFalse(TokenValidation::validate('1ba4'));
    }
}
