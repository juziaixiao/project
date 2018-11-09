<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/21
 * Time: 13:33
 */

namespace app\lib\exception;


class Imageexception extends BaseException
{
    public $code = 401;
    public $msg = '获取图片失败';
    public $errorCode = 'AD30001';
}