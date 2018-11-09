<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/21
 * Time: 13:33
 */

namespace app\lib\exception;


class Bannerexception extends BaseException
{
    public $code = 401;
    public $msg = '获取banner失败';
    public $errorCode = 'AD20000';
}