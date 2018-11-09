<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\lib\exception;
use think\Exception;

/**
 * 微信服务器异常
 */
class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = 'wechat unknown error';
    public $errorCode = 999;
}