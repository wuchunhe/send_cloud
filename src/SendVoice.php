<?php
/**
 * SendVoice.php
 * User: wuchunhe
 * Date: 2021/5/27 2:59 下午
 */

//语言发送
namespace sendcloud;

use sendcloud\lib\SendCloudSMS;
use sendcloud\lib\util\SmsMsg;
use sendcloud\lib\util\VoiceMsg;
use sendcloud\lib\util\MsgType;

class SendVoice
{
    function sendVoice()
    {
        $SMS_USER = "***";
        $SMS_KEY = "***";
        $sendSms = new SendCloudSMS($SMS_USER, $SMS_KEY);
        $voiceMsg = new VoiceMsg();
        $voiceMsg->setCode("1234");
        $voiceMsg->setPhone("13871506390");
        //$voiceMsg->setTimestamp(time());
        $resonse = $sendSms->sendVoice($voiceMsg);
        echo $resonse->body();

    }
}