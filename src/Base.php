<?php
/**
 * Base.php
 * User: wuchunhe
 * Date: 2021/5/27 3:17 下午
 */


namespace sendcloud;


class Base
{
    public $api_user;
    public $api_key;

    public function __construct()
    {
        $this->api_user = env('SEND_CLOUD_USER');
        $this->api_key  = env('SEND_CLOUD_KEY');
    }
}