<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/21
 * Time: 14:22
 */

namespace app\lib\exception;


class Errorexception  extends BaseException
{
    public $code = 500;
    public $msg = '失败';
    public $errorCode = 'AD00000';
}