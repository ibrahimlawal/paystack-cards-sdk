<?php
namespace Paystack\Cards\Test\Mock;

use \Yabacon\Paystack\Exception\ApiException;

class PaystackPhpTransactionTestDouble
{
    function initialize(array $arr)
    {
        if (isset($arr['email']) && isset($arr['amount'])) {
            $email = filter_var($arr['email'], FILTER_VALIDATE_EMAIL);
            $amount = filter_var($arr['amount'], FILTER_VALIDATE_INT);
            if ($email && $amount) {
                $acc_code = 'jy'.dechex(rand(100000, 88983893));
                return json_decode('{
                  "status": true,
                  "message": "Authorization URL created",
                  "data": {
                    "authorization_url": "https://paystack.com/secure/'.$acc_code.'",
                    "access_code": "'.$acc_code.'",
                    "reference": "'.strrev($acc_code).'"
                  }
                }');
            }
        }
        throw new ApiException(
            'Paystack Request failed with response: \'Invalid amount sent\'',
            json_decode('{"status": false, "message": "Invalid amount sent"}')
        );
    }

    function verifyAccessCode(array $arr)
    {
        if (isset($arr['access_code']) && ($access_code = $arr['access_code'])) {
            $san = preg_replace("/[^a-z0-9 ]/", '', $access_code);
            if ($san === $access_code) {
                $id = rand(10000000, 88903893);
                return json_decode('{
                          "status": true,
                          "message": "Access code validated",
                          "data": {
                            "email": "ibrahim@paytsack.co",
                            "merchant_logo": "https://watchtower.paystack.co/assets/img/logo.svg",
                            "merchant_name": "Paystack Mock",
                            "amount": 100,
                            "domain": "live",
                            "currency": "NGN",
                            "id": '.$id.',
                            "channels": [
                              "card"
                            ],
                            "label": "",
                            "merchant_key": "pk_blah"
                          }
                        }');
            }
        }
        throw new ApiException(
            'Paystack Request failed with response: \'Not found\'',
            json_decode('{"status": false, "message": "Not found"}')
        );
    }

    function verify(array $arr)
    {
        if (isset($arr['reference']) && ($reference = $arr['reference'])) {
            if ($reference === 'blah') {
                return json_decode('{
                  "status": true,
                  "message": "Verification successful",
                  "data": {
                    "amount": 10000,
                    "currency": "NGN",
                    "transaction_date": "2017-05-08T20:03:08.000Z",
                    "status": "success",
                    "reference": "'.$reference.'",
                    "domain": "live",
                    "metadata": "",
                    "gateway_response": "The transaction was not completed",
                    "message": null,
                    "channel": "card",
                    "ip_address": "",
                    "log": null,
                    "fees": null,
                    "authorization": {
                      "authorization_code": "AUTH_blah",
                      "bin": "506066",
                      "last4": "6666",
                      "exp_month": "01",
                      "exp_year": "99",
                      "channel": "card",
                      "card_type": "verve",
                      "bank": "",
                      "country_code": "NG",
                      "brand": "verve",
                      "reusable": "false",
                      "signature": "SIG_blah"
                    },
                    "customer": {
                      "id": 169869,
                      "first_name": null,
                      "last_name": null,
                      "email": "blah@example.com",
                      "customer_code": "CUS_blah",
                      "phone": null,
                      "metadata": null,
                      "risk_action": "default"
                    },
                    "plan": null
                  }
                }');
            }
        }
        throw new ApiException(
            'Paystack Request failed with response: \'Not found\'',
            json_decode('{"status": false, "message": "Not found"}')
        );
    }
}
