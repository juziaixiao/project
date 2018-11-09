<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\api\behavior;



use think\Request;
use think\Response;
use think\response\Redirect;
use think\Session;

class CORS
{
    public function appInit(&$params)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');
        if(request()->isOptions()){
            exit();
        }
    }
}