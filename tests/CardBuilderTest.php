<?php
namespace Paystack\Cards\Test;

use Paystack\Cards\CardBuilder;
use Paystack\Cards\Exception\IncompleteCardDetailsException;

class CardBuilderTest extends \PHPUnit_Framework_TestCase
{
    protected $cardbuilder;

    protected function setUp()
    {
        $this->cardbuilder = new CardBuilder();
        $this->cardbuilder
            ->withPan('4084084084084081')
            ->withCvc('408')
            ->withExpiryMonth('01')
            ->withExpiryYear('88');
    }

    public function testWithPan()
    {
        $newpan = '4123450131001381';
        $this->cardbuilder->withPan($newpan);
        $card = $this->cardbuilder->build();
        $this->assertEquals($newpan, $card->pan);
    }

    public function testWithCvc()
    {
        $newcvc = '883';
        $this->cardbuilder->withCvc($newcvc);
        $card = $this->cardbuilder->build();
        $this->assertEquals($newcvc, $card->cvc);
    }

    public function testWithExpiryMonth()
    {
        $new = '12';
        $this->cardbuilder->withExpiryMonth($new);
        $card = $this->cardbuilder->build();
        $this->assertEquals($new, $card->exp_month);
        $new = '1';
        $this->cardbuilder->withExpiryMonth($new);
        $card = $this->cardbuilder->build();
        $this->assertEquals($new, $card->exp_month);
    }

    public function testWithExpiryYear()
    {
        $new = '99';
        $this->cardbuilder->withExpiryYear($new);
        $card = $this->cardbuilder->build();
        $this->assertEquals($new, $card->exp_year);
        $new = date('Y');
        $this->cardbuilder->withExpiryYear($new);
        $card = $this->cardbuilder->build();
        $this->assertEquals($new, $card->exp_year);
    }

    public function testThrowExceptionWhenNoParams()
    {
        $cardbuilder = new CardBuilder();
        $this->expectException(IncompleteCardDetailsException::class);
        $cardbuilder->build();
    }
}
