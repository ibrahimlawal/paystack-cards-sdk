<?php

namespace Paystack\Cards\Test\Validation;

use Paystack\Cards\Validation\CardValidation;
use Paystack\Cards\CardBuilder;

class CardValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateCard()
    {
        $cardbuilder = new CardBuilder();
        $card = $cardbuilder
            ->withPan('4084084084084081')
            ->withCvc('408')
            ->withExpiryMonth('01')
            ->withExpiryYear('88')
            ->build();
        $this->assertTrue(CardValidation::validateCard($card));
    }
    
    public function testValidatePan()
    {
        $this->assertTrue(CardValidation::validatePan('5399539953995391'));
        $this->assertFalse(CardValidation::validatePan('5399539953995399'));
        $this->assertFalse(CardValidation::validatePan(''));
    }

    public function testValidateCvc()
    {
        $this->assertTrue(CardValidation::validateCvc('123'));
        $this->assertTrue(CardValidation::validateCvc('1234'));
        $this->assertFalse(CardValidation::validateCvc('12345'));
        $this->assertFalse(CardValidation::validateCvc(''));
    }

    public function testValidateExpiryMonth()
    {
        $this->assertFalse(CardValidation::validateExpiryMonth('123'));
        $this->assertTrue(CardValidation::validateExpiryMonth('12'));
        $this->assertTrue(CardValidation::validateExpiryMonth('1'));
        $this->assertFalse(CardValidation::validateExpiryMonth(''));
    }

    public function testValidateExpiryYear()
    {
        $this->assertFalse(CardValidation::validateExpiryYear('2013'));
        $this->assertTrue(CardValidation::validateExpiryYear(date('Y')));
        $this->assertFalse(CardValidation::validateExpiryYear('00'));
        $this->assertTrue(CardValidation::validateExpiryYear(99));
    }

    public function testValidateVisaPan()
    {
        $this->assertTrue(CardValidation::validateVisaPan('4084084084084081'));
        $this->assertFalse(CardValidation::validateVisaPan('5399084084084084'));
        $this->assertFalse(CardValidation::validateVisaPan(''));
    }

    public function testValidateMasterCardPan()
    {
        $this->assertTrue(CardValidation::validateMasterCardPan('5399539953995391'));
        $this->assertFalse(CardValidation::validateMasterCardPan('4084084084084084'));
        $this->assertFalse(CardValidation::validateMasterCardPan(''));
    }

    public function testValidateVervePan()
    {
        $this->assertTrue(CardValidation::validateVervePan('5060996666666666666'));
        $this->assertTrue(CardValidation::validateVervePan('5061986666666666666'));
        $this->assertTrue(CardValidation::validateVervePan('5078656666666666666'));
        $this->assertTrue(CardValidation::validateVervePan('5079646666666666666'));
        $this->assertTrue(CardValidation::validateVervePan('6500026666666666'));
        $this->assertTrue(CardValidation::validateVervePan('6500276666666666'));
    }
}
