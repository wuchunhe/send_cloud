<?php
/**
 * SendMail.php
 * User: wuchunhe
 * Date: 2021/5/27 2:13 下午
 */

//邮件发送
namespace sendcloud;

use sendcloud\lib\util\HttpClient;
use sendcloud\lib\SendCloud;
use sendcloud\lib\util\Attachment;
use sendcloud\lib\util\Mail;
use sendcloud\lib\util\TemplateContent;
use sendcloud\lib\util\Mimetypes;

class SendMail extends Base
{

    public function __init($version = 'v1')
    {
        return new SendCloud($this->api_user, $this->api_key, $version);
    }

    function sendCommonMail()
    {
        $sendcloud = $this->__init('v1');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("ben@ifaxin.com");
        $mail->setReplyTo("reply@test.com");
        $mail->setFromName("来自测试发送");
        $mail->setContent("这是一封测试邮件");
        $mail->setSubject("测试");
        $mail->setRespEmailId(true);
        //添加多个邮件头
        $mail->addHeader("header1", "header2");
        $mail->addHeader("header2", "header2");
        $sendcloud->sendCommon($mail);

    }

    function sendCommonMail_v2()
    {
        $sendcloud = $this->__init('v2');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("ben@ifaxin.com");
        $mail->setFromName("来自测试发送");
        $mail->setSubject("测试");
        $mail->setContent("这是一封测试邮件");
        $mail->setRespEmailId(true);
        $mail->setLabel(14411);
        //添加多个邮件头
        $mail->addHeader("header1", "header1");
        $mail->addHeader("header2", "header2");
        $sendcloud->sendCommon($mail);

    }


    function sendCommonMailWithAddress()
    {
        $sendcloud = new SendCloud("***", "***", 'v1');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("ben@ifaxin.com");
        $mail->addTo("noexist@maillist.sendcloud.org");
        $mail->setContent("测试，通过地址列表");
        $mail->setSubject("这是一封测试邮件");
        $mail->setRespEmailId(true);
        $mail->setUseMaillist(true);
        $mail->setLabel(14411);
        //添加多个邮件头
        $mail->addHeader("header1", "header1");
        $mail->addHeader("header2", "header2");
        $sendcloud->sendCommon($mail);
    }

    function sendCommonMailWithAddress_v2()
    {
        $sendcloud = new SendCloud("***", "***", 'v2');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("noexist@maillist.sendcloud.org");
        $mail->setFromName("来自测试发送");
        $mail->setContent("这是一封测试邮件");
        $mail->setSubject("测试，通过地址列表");
        $mail->setRespEmailId(true);
        $mail->setUseMaillist(true);
        $mail->setLabel(14411);
        //添加多个邮件头
        $mail->addHeader("header1", "header1");
        $mail->addHeader("header2", "header2");
        $sendcloud->sendCommon($mail);
    }

    function sendTemplateMail()
    {
        $sendcloud = new SendCloud("***", "***", 'v1');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("x@sendcloud.im");
        $mail->addTo("m@sendcloud.im");
        $mail->setSubject("测试，通过模板发送");
        $mail->setRespEmailId(true);

        //use_maillist=false,收件人填在TemplateVars中
        $templateContent = new TemplateContent();
        $templateContent->addVars("%name%", array("x1", "x2"));
        $templateContent->addVars("%money%", array(100, 200));
        $templateContent->setTemplateInvokeName("zh");
        $mail->setTemplateContent($templateContent);
        $sendcloud->sendTemplate($mail);

    }

    /**
     * 当$mail->setUseMaillist(true); 设置时候$mail->addTo 指的是 地址列表
     * 当$mail->setUseMaillist(false);设置时候$mail->setXsmtpApi 中的to指的是收件人地址，此时$mail->addTo 失效
     */
    function sendTemplateMail_v2()
    {
        $sendcloud = new SendCloud("***", "***", 'v2');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");

        $mail->setXsmtpApi(json_encode(array(
            'to' => array('test@ifaxin.com', 'test2@ifaxin.com'),
            'sub' => array(
                '%money%' => array('123', '456')


            )


        )));
        $mail->setSubject("测试，通过模板发送");
        $mail->setRespEmailId(true);
        $templateContent = new TemplateContent();
        $templateContent->setTemplateInvokeName("zh");
        $mail->setTemplateContent($templateContent);
        $sendcloud->sendTemplate($mail);

    }

    function sendTemplateMailWithAddress()
    {
        $sendcloud = new SendCloud("***", "***", 'v1');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("xjm@maillist.sendcloud.org");
        $mail->setSubject("SendCloud python common");
        $mail->setRespEmailId(true);
        $mail->setUseMaillist(true);
        $templateContent = new TemplateContent();
        $templateContent->setTemplateInvokeName("active");
        $mail->setTemplateContent($templateContent);
        $sendcloud->sendTemplate($mail);
    }


    function sendTemplateMailWithAddress_v2()
    {
        $sendcloud = new SendCloud("***", "***", 'v2');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("xjm@maillist.sendcloud.org");
        $mail->setSubject("测试通过地址列表模板发送");
        $mail->setRespEmailId(true);
        $mail->setUseMaillist(true);
        $templateContent = new TemplateContent();
        $templateContent->setTemplateInvokeName("active");
        $mail->setTemplateContent($templateContent);
        $sendcloud->sendTemplate($mail);
    }


    function sendTemplateMailWithAddressAndAttachment()
    {
        $sendcloud = new SendCloud("***", "***", 'v1');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("xjm@maillist.sendcloud.org");
        $mail->setSubject("测试带附件发送");
        $mail->setRespEmailId(true);
        $mail->setUseMaillist(true);
        $templateContent = new TemplateContent();
        $templateContent->setTemplateInvokeName("active");
        $mail->setTemplateContent($templateContent);
        $file = "C:\\test_email\\test.pdf"; #你的附件路径
        $handle = fopen($file, 'rb');
        $content = fread($handle, filesize($file));
        $filetype = Mimetypes::getInstance()->fromFilename($file);


        $file2 = "C:\\test_email\\xiao.txt";
        $handle2 = fopen($file2, 'rb');
        $content2 = fread($handle2, filesize($file2));
        $filetype2 = Mimetypes::getInstance()->fromFilename($file2);


        $file3 = "C:\\test_email\\test.png";
        $handle3 = fopen($file3, 'rb');
        $content3 = fread($handle3, filesize($file3));

        $filetype3 = Mimetypes::getInstance()->fromFilename($file3);
        $file4 = "C:\\test_email\\test.doc";
        $handle4 = fopen($file4, 'rb');
        $content4 = fread($handle3, filesize($file4));
        $filetype4 = Mimetypes::getInstance()->fromFilename($file4);

        $attachment = new Attachment();


        $attachment->setType($filetype);
        $attachment->setContent($content);
        $attachment->setFilename("[从零开始：Windows7中文版基础培训教程].老虎工作室,.高清文字版 (1).pdf");

        $attachment1 = new Attachment();
        $attachment1->setType($filetype);
        $attachment1->setContent($content2);
        $attachment1->setFilename("xiao.txt");

        $attachment2 = new Attachment();
        $attachment2->setType($filetype3);
        $attachment2->setContent($content3);
        $attachment2->setFilename("test.png");


        $attachment3 = new Attachment();

        $attachment3->setContent($content4);
        $attachment3->setFilename("java文档.doc");

        $attachment3->setType($filetype4);
        $mail->addAttachment($attachment);
        $mail->addAttachment($attachment1);
        $mail->addAttachment($attachment2);
        $mail->addAttachment($attachment3);


        fclose($handle);
        fclose($handle2);
        fclose($handle3);

        $sendcloud->sendTemplate($mail);

    }


    function sendTemplateMailWithAddressAndAttachment_v2()
    {

        $sendcloud = new SendCloud("***", "***", 'v2');
        $mail = new Mail();
        $mail->addBcc("lianzimi@ifaxin.com");
        $mail->addCc("bida@ifaxin.com");
        $mail->setFrom("test@test.com");
        $mail->addTo("xjm@maillist.sendcloud.org");
        $mail->setSubject("测试带附件发送");
        $mail->setRespEmailId(true);
        $mail->setUseMaillist(true);
        $templateContent = new TemplateContent();
        $templateContent->setTemplateInvokeName("active");
        $mail->setTemplateContent($templateContent);
        $file = "C:\\test_email\\test.pdf"; #你的附件路径
        $handle = fopen($file, 'rb');
        $content = fread($handle, filesize($file));
        $filetype = Mimetypes::getInstance()->fromFilename($file);


        $file2 = "C:\\test_email\\xiao.txt";
        $handle2 = fopen($file2, 'rb');
        $content2 = fread($handle2, filesize($file2));
        $filetype2 = Mimetypes::getInstance()->fromFilename($file2);


        $file3 = "C:\\test_email\\test.png";
        $handle3 = fopen($file3, 'rb');
        $content3 = fread($handle3, filesize($file3));

        $filetype3 = Mimetypes::getInstance()->fromFilename($file3);
        $file4 = "C:\\test_email\\test.doc";
        $handle4 = fopen($file4, 'rb');
        $content4 = fread($handle3, filesize($file4));
        $filetype4 = Mimetypes::getInstance()->fromFilename($file4);

        $attachment = new Attachment();


        $attachment->setType($filetype);
        $attachment->setContent($content);
        $attachment->setFilename("[从零开始：Windows7中文版基础培训教程].老虎工作室,.高清文字版 (1).pdf");

        $attachment1 = new Attachment();
        $attachment1->setType($filetype);
        $attachment1->setContent($content2);
        $attachment1->setFilename("xiao.txt");

        $attachment2 = new Attachment();
        $attachment2->setType($filetype3);
        $attachment2->setContent($content3);
        $attachment2->setFilename("test.png");


        $attachment3 = new Attachment();

        $attachment3->setContent($content4);
        $attachment3->setFilename("java文档.doc");

        $attachment3->setType($filetype4);
        $mail->addAttachment($attachment);
        $mail->addAttachment($attachment1);
        $mail->addAttachment($attachment2);
        $mail->addAttachment($attachment3);


        fclose($handle);
        fclose($handle2);
        fclose($handle3);

        $sendcloud->sendTemplate($mail);

    }


    /*****************api  v1*******************/
//普通发送

//sendCommonMail();

//普通发送带地址邮件
//sendCommonMailWithAddress();
//模板带变量发送
//sendTemplateMail();
//模板带地址列表
//sendTemplateMailWithAddress();
//模板带地址列表，带附件
//sendTemplateMailWithAddressAndAttachment();


    /*****************api v2************************/

//sendCommonMail_v2();
//sendCommonMailWithAddress_v2();
//sendTemplateMail_v2();
//sendTemplateMailWithAddress_v2();
//sendTemplateMailWithAddressAndAttachment_v2();


}