<?php
/**
 * @爱帮合伙人
 * @Create 丁文爽
 * @Date 2018/11/3
 * @Email:d_wo@chunyimail.com
 * @Context  admin模块基础控制器类
 */
namespace app\admin\controller;
use think\Controller;

use think\facade\Session;

class Basecontroller extends Controller
{
    public function __construct()
    {
    
        parent::__construct();
//        Session::set('fromlogin',null);
   
        $userinfo=Session::get('userinfo');
        $fromlogin= Session::get('fromlogin');

        if((!$userinfo||is_null($userinfo))and!$fromlogin){
            $this->error('登陆','admin/login',3);
        }
    }


}