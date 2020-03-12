<?php


namespace App\Services\Payment;
use App\Models\Order;
use GuzzleHttp;

class RazorPayService
{

    public $merchantkey='EPGSjVVzv07F0l';
    public $api_key='rzp_test_x8wFaxFW3KL1d7';
    protected $api_secret='s6zlFAgYXFm5MemLZny4dBCY';

    protected $endpoint='https://api.razorpay.com/v1/orders';

    public function __construct(GuzzleHttp\Client $client){
        $this->client=$client;
    }


    public function generateorderid($data){

        try{
            //die('dsd');
            $response = $this->client->post($this->endpoint, [GuzzleHttp\RequestOptions::JSON =>$data, GuzzleHttp\RequestOptions::AUTH => [$this->api_key,$this->api_secret]]);
            //die('dsd');
            $body=$response->getBody()->getContents();

        }catch(GuzzleHttp\Exception\TransferException $e){
            $body=$e->getResponse()->getBody()->getContents();
        }
        return $body;
    }

    public function verifypayment($data){
        $generated_signature = hash_hmac('sha256', $data['razorpay_order_id'] . "|" . $data['razorpay_payment_id'], $this->api_secret);
        //return true;
        if ($generated_signature == $data['razorpay_signature']) {
           return true;
        }
        return false;
    }
}
