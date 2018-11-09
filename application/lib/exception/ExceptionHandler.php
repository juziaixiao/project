<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\facade\Log;
use think\facade\Url;
use think\Request;

/*
 * 重写Handle的render方法，实现自定义异常消息
 */
class ExceptionHandler extends Handle
{

    private $code;
    private $msg;
    private $errorCode;


    public function render(\Exception $e)

     {

        if ($e instanceof BaseException) {
           $this->recordErrorLog($e);
        //如果当前模块是admin则跳转到提示信息页面

            $request=new Request();
            if( $request->module()=='admin'){
                $rootinfo=[
                    'msg'=>$e->msg,
                    'errorcode'=>$e->errorCode,
                    'code'=> $e->code
                ];

                $url=Url::build('/admin/index/aderror',
                    $rootinfo);
                return redirect($url);
            }else{
                //如果当前模块是小程序端：
                //如果是自定义异常，则控制http状态码，不需要记录日志
                //因为这些通常是因为客户端传递参数错误或者是用户请求造成的异常
                //不应当记录日志

                $this->code = $e->code;
                $this->msg = $e->msg;
                $this->errorCode = $e->errorCode;
            }
        }
        else{
            // 如果是服务器未处理的异常，将http状态码设置为500，并记录日志
            if(config('app_debug')){
                // 调试状态下需要显示TP默认的异常页面，因为TP的默认页面
                // 很容易看出问题

                return parent::render($e);
            }
            $this->code = 500;
            $this->msg = '服务器内部错误(^o^)Y';
            $this->errorCode = 999;
        }


         $request=new Request();
        $result = [
            'msg'  => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request = $request->url()
        ];
        return json($result, $this->code);
    }

    /*
     * 将异常写入日志
     */
    private function recordErrorLog(\Exception $e)
    {
        Log::record($e->getMessage(),'error');
    }
}