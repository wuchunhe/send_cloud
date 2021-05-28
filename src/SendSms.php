<?php
/**
 * SendSms.php
 * User: wuchunhe
 * Date: 2021/5/27 2:54 下午
 */
//短信发送
namespace sendcloud;

use sendcloud\lib\SendCloudSMS;
use sendcloud\lib\util\SmsMsg;
use sendcloud\lib\util\VoiceMsg;
use sendcloud\lib\util\MsgType;

class SendSms
{
    function sendsms()
    {
        $SMS_USER = "***";
        $SMS_KEY = "***";
        $smsTemplateId = 1;
        $sendSms = new SendCloudSMS($SMS_USER, $SMS_KEY);
        $smsMsg = new SmsMsg();
        $smsMsg->addPhoneList(array("13871506390"));
        $smsMsg->addVars("code", "1234");
        $smsMsg->setTemplateId($smsTemplateId);
        $smsMsg->setTimestamp(time());
        $resonse = $sendSms->send($smsMsg);
        echo $resonse->body();

    }


    function sendMms()
    {
        $SMS_USER = "***";
        $SMS_KEY = "***";
        $mmsTemplateId = 320;
        $sendSms = new SendCloudSMS($SMS_USER, $SMS_KEY);
        $smsMsg = new SmsMsg();
        $smsMsg->addPhoneList(array("13871506390"));
        $smsMsg->addVars("code", "1234");
        $smsMsg->setMsgType(MsgType::MMS);

        $smsMsg->addMapVars(array("name" => 'xiao'));
        $smsMsg->setTemplateId($mmsTemplateId);
        $smsMsg->setTimestamp(time());
        $resonse = $sendSms->send($smsMsg);
        echo $resonse->body();

    }
}