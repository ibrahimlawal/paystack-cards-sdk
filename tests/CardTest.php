<?php

namespace Paystack\Cards\Test;

use Paystack\Cards\Exception\IncompleteCardDetailsException;
use Paystack\Cards\Card;

class CardTest extends \PHPUnit_Framework_TestCase
{
    public function testInitializeBadCard()
    {
        $this->expectException(IncompleteCardDetailsException::class);
        $e = new Card('5061badcard', '000', '01', '20');
    }

    public function testInitializeOkayCard()
    {
        $e = new Card('5060666666666666666', '123', '12', '34');
    }
}
