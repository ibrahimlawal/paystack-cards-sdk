<?php
namespace Paystack\Cards\Test;

use Yabacon\Paystack\Exception\ValidationException;

use Paystack\Cards\Card;
use Paystack\Cards as PaystackCards;
use Paystack\Cards\Transport\ChargeRequest;
use Paystack\Cards\Transport\ValidateRequest;
use Paystack\Cards\Test\Mock\CardsTestDouble;
use Paystack\Cards\Exception\BadAccessCodeException;

class CardsTest extends \PHPUnit_Framework_TestCase
{
    private $paystackCards;
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

    public function testConstruct()
    {
        $paystackCards =new PaystackCards(
            'sk_blah',
            function ($transaction) {
            },
            function ($message) {
            },
            function ($message) {
            },
            function ($message) {
            },
            function ($message) {
            },
            function ($message) {
            },
            function ($url) {
            }
        );
        $this->assertNotNull($paystackCards);
    }

    public function testStartTransactionReturningAccessCode()
    {
        $this->access_code = $this->paystackCards->startTransactionReturningAccessCode('yh@ex.com', 1000);
        $this->assertNotNull($this->access_code);
    }

    public function testChargeCard()
    {
        $this->paystackCards->chargeCard('blah', 'device_blah', $this->card);
        $this->assertEquals($this->methodCalled, 'pin');
        $this->paystackCards->chargeCard('blah', 'device_blah', $this->card, '1234');
        $this->assertEquals($this->methodCalled, 'phone');
    }

    public function testBadAccessCode()
    {
        $this->expectException(BadAccessCodeException::class);
        $this->paystackCards->chargeCard(null, 'device_blah', $this->card);
    }

    public function testBadPhone()
    {
        $this->expectException(ValidationException::class);
        $this->paystackCards->validatePhone('blah', '');
    }

    public function testBadOtp()
    {
        $this->expectException(ValidationException::class);
        $this->paystackCards->validateOtp('blah', '');
    }

    public function testBadPinCharacters()
    {
        $this->expectException(ValidationException::class);
        $this->paystackCards->chargeCard('blah', 'device_blah', $this->card, '1bad');
    }

    public function testShortPin()
    {
        $this->expectException(ValidationException::class);
        $this->paystackCards->chargeCard('blah', 'device_blah', $this->card, '12');
    }

    public function testRequestClasses()
    {
        $v = $this->paystackCards->superValidateRequestClass();
        $this->assertEquals($v, 'Paystack\Cards\Transport\ValidateRequest');
        $v = $this->paystackCards->superChargeRequestClass();
        $this->assertEquals($v, 'Paystack\Cards\Transport\ChargeRequest');
    }

    public function testValidatePhone()
    {
        $this->paystackCards->validatePhone('blah', '08123456789');
        $this->assertEquals($this->methodCalled, 'otp');
    }

    public function testValidateOtp()
    {
        $this->paystackCards->validateOtp('blah', '654321');
        $this->assertEquals($this->methodCalled, 'failed');
        $this->paystackCards->validateOtp('blah', '123456');
        $this->assertEquals($this->methodCalled, 'success');
        $this->paystackCards->validateOtp('blah', '012345');
        $this->assertEquals($this->methodCalled, 'threeds');
        $this->paystackCards->validateOtp('blah', '901234');
        $this->assertEquals($this->methodCalled, 'timeout');
    }
}
