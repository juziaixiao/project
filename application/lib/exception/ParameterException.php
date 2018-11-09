<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\lib\exception;

/**
 * Class ParameterException
 * 通用参数类异常错误
 */
class ParameterException extends BaseException
{
    public $code = 400;
    public $errorCode = 10000;
    public $msg = "invalid parameters";
}