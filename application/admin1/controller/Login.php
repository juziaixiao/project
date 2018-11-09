<?php
/**
 * @projectname
 * @version 1.0
 * @author 鞠慧宇
 * @date 2018/10/18
 * @email:juziaixiao@chunyimail.com
 * @context 登陆
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;

class Login extends Controller
{

    /**
     * @access public
     * @return mixed
     * @context admin登陆
     */
    public  function index(){

        return view();
    }
    /**
     * @access public
     * @return mixed
     * @context 执行登陆
     */
    public  function tologin(Request $request){

        Session::set('fromlogin',1);
        $username= $request->post('username');
        $password=$request->post('password');
        if($username&&$password){
            Session::set('userinfo',array('username'=>$username,'password'=>$password));
            $this->success('登陆成功','/admin/welcome',3);
        }

    }

    /**
     * @access public
     * @return mixed
     * @context admin推出
     */
    public  function logout(){
        Session::clear();
        $this->success('退出成功','/admin/login',3);
    }
}