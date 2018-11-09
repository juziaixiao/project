<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/10/25
 * @email:d_w@chunyimail.com
 * @context 登陆退出
 */
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Login as LoginModel;


class Login extends Controller{

    /**
     * @access public
     * @return mixed
     * @context 账号登陆页
     */
    public function login(){
        return View();
    }

    /**
     * @access public
     * @return mixed
     * @context 账号登陆页
     */
    public function dologin(){
        $status = LoginModel::dologin();
        $this -> success("登陆成功",'/admin/Index/index');
    }

    /**
     * @access public
     * @return mixed
     * @context 修改管理员信息页面
     */
    public function edit(){
        $list = LoginModel::edit();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 修改管理员信息页面
     */
    public function doedit(){
        $list = LoginModel::doedit();
        $this -> success("修改成功！",'/admin/login/edit');
    }

//    /**
//     * @access public
//     * @return mixed
//     * @context 账号登陆
//     */
//    public function login(){
//       // phpinfo();exit;
//        if($this->request->isPost()){
//            $request = new Request();
//            $get = $request->get();
//            $post = Request::instance()->post();
//            $status = LoginModel::Login($post);
//            if($status == 1){
//                $this -> success("登陆成功",'/admin/Index/index');
//            }
//        }else{
//            return view();
//        }
//    }


    /**
     * @access public
     * @return mixed
     * @context 账号退出
     */
    public  function logout(){
        Session::clear();
        $this->success('退出成功','/admin/login/login',3);
    }
}