<?php

namespace Paystack\Cards\Test\Validation;

use Paystack\Cards\Validation\PhoneValidation;

class PhoneValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $this->assertTrue(PhoneValidation::validate('08123456789'));
    }
}
