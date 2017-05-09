<?php
namespace Paystack\Cards\Test\Transport;

use Paystack\Cards\Exception\EncryptionException;
use Paystack\Cards\Transport\Encryptor;

class EncryptorTest extends \PHPUnit_Framework_TestCase
{
    public function testTooLongInput()
    {
        $this->expectException(EncryptionException::class);
        $extremelylongstring = str_repeat('iWill_be_long', 80);
        $r = Encryptor::encrypt($extremelylongstring);
    }
}
