<?php
/**
 * @Projectname
 * @Create 鞠慧宇
 * @Date 2018/10/17
 * @Email:juziaixiao@chunyimail.com
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

        if((empty($userinfo)||is_null($userinfo))and!$fromlogin){
            $this->error('登陆','admin/login',3);
        }
    }


}