<?php
namespace Paystack\Cards\Test\Mock;

class PaystackPhpTestDouble
{
    public $transaction;

    function __construct()
    {
        $this->transaction = new PaystackPhpTransactionTestDouble();
    }

    function disableFileGetContentsFallback()
    {
    }
}
