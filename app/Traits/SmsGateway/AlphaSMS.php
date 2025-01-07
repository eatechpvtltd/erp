<?php
namespace App\Traits\SmsGateway;

trait AlphaSMS{


    public function alphaSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['AlphaSMS'],true);
        $username = $sms['UserName'];
        $hash = $sms['Hash']; //generate token from the control panel
        $message = str_replace(' ','%20',$message);

        $params = array('app'=>'ws', 'u'=>$username, 'h'=>$hash, 'op'=>'pv', 'to'=>$contactNumbers, 'msg'=>$message);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://alphasms.biz/index.php?".http_build_query($params, '', '&'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Accept:application/json"));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($ch);
        curl_close ($ch);
    }


}