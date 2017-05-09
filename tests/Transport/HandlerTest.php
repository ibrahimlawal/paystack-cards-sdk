<?php
namespace Paystack\Cards\Test\Transport;

use Paystack\Cards\Card;
use Paystack\Cards\Exception\TransportException;
use Paystack\Cards\Test\Mock\CardsTestDouble;

class HandlerTest extends \PHPUnit_Framework_TestCase
{
    private $paystackCards;
    private $handler;
    private $card;
    private $methodCalled;

    public function setUp()
    {
        $this->paystackCards =new CardsTestDouble(
            'sk_blah',
            function ($transaction) {
                $this->methodCalled = 'success';
                $this->assertEquals($transaction->data->status, 'success');
            },
            function ($message) {
                $this->methodCalled = 'failed';
                $this->assertEquals($message, 'Transaction Error');
            },
            function ($message) {
                $this->methodCalled = 'pin';
                $this->assertEquals($message, 'Please send PIN');
            },
            function ($message) {
                $this->methodCalled = 'otp';
                $this->assertEquals($message, 'Enter the OTP code 123456 to get a successful transaction');
            },
            function ($message) {
                $this->methodCalled = 'phone';
                $this->assertEquals($message, 'Enter some random phone');
            },
            function ($message) {
                $this->methodCalled = 'timeout';
                $this->assertEquals($message, 'Oooops, your payment has exceeded the time to pay.');
            },
            function ($url) {
                $this->methodCalled = 'threeds';
                $this->assertEquals($url, 'https://paystack.co/blah');
            }
        );
        $this->card = new Card('5060666666666666666', '123', '12', '34');
    }

    public function testThrowTransportException()
    {
        $this->expectException(TransportException::class);
        $this->paystackCards->getHandler()->publiclyHandle('1', null);
    }

    public function testHandleRequeryTillFalse()
    {
        $this->expectException(TransportException::class);
        $this->paystackCards->getHandler()->publiclyHandle('2', json_decode('{"status":"requery"}'));
    }

    public function testHandleRequeryTillGiveUp()
    {
        $this->paystackCards->getHandler()->publiclyHandle('1', json_decode('{"status":"requery"}'));
    }

    public function testRequestClass()
    {
        $v = $this->paystackCards->getHandler()->superRequestClass();
        $this->assertEquals($v, 'Paystack\Cards\Transport\Request');
    }
}
