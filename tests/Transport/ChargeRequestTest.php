<?php
namespace Paystack\Cards\Test\Mock;

use Paystack\Cards\Card;
use Paystack\Cards\Transport\ChargeRequest;
use Paystack\Cards\Exception\IncompleteCardDetailsException;

class ChargeRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $this->expectException(IncompleteCardDetailsException::class);
        $e = new ChargeRequest(null, null, new Card(null, null, null, null), null);
    }
}
