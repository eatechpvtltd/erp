<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait WhatsAppGreenAPI{

    /*WhatsAppGreenAPI SMS*/
    public function WhatsAppGreenAPISMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['GreenAPI'],true);
        $idInstance = $sms['idInstance'];
        $apiTokenInstance = $sms['apiTokenInstance'];
        //$contactNumbers = implode(',',$contactNumbers);
        $contactNumbers = str_replace(' ','',$contactNumbers);



        //The idInstance and apiTokenInstance values are available in your account, double brackets must be removed
        $url = 'https://api.green-api.com/waInstance'.$idInstance.'/sendMessage/'.$apiTokenInstance;

        //chatId is the number to send the message to (@c.us for private chats, @g.us for group chats)
        $data = array(
            'chatId' => '9779868156047',
            'message' => $message
        );

        $options = array(
            'http' => array(
                'header' => "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);
        //dd($context);

        $response = file_get_contents($url, false, $context);
        dd($response);

        echo $response;
    }



}