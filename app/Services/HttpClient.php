<?php

namespace App\Services;

use Illuminate\Http\Response;

class HttpClient
{
    /**
     * Check the mock if the transaction is authorized
     *
     * @param $transaction
     * @return false
     */
    public static function authorizeTransaction($transaction)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            env('API_AUTHORIZE_TRANSACTION')
        );

        if ($response->getStatusCode() === Response::HTTP_OK) {

            $response_value = json_decode($response->getBody()->getContents());

            return (bool) $response_value;
        } else {

            return false;
        }
    }

    /**
     * Send payment received notification
     *
     * @return false
     */
    public static function paymentReceivedNotification()
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            env('API_NOTIFICATION')
        );

        if ($response->getStatusCode() === Response::HTTP_OK) {

            $response_value = json_decode($response->getBody()->getContents());

            return (bool) $response_value;
        } else {

            return false;
        }
    }
}
