<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/7
 * @email:d_w@chunyimail.com
 * @context 后台登陆
 */

namespace app\admin\controller;

use think\Controller;
use think\facade\Session;
use app\admin\model\Login as loginModel;

class Login extends Controller
{

    /**
     * @access public
     * @return mixed
     * @context admin登陆
     */
    public function login()
    {
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 执行登陆
     */
    public function doLogin()
    {
        $list = loginModel::doLogin();
//        echo "123";die();
        $this->success('登录成功！', '/admin/Index/index', 3);
    }

    /**
     * @access public
     * @return mixed
     * @context admin推出
     */
    public function logout()
    {
        Session::clear();
        $this->success('退出成功', '/admin/login/login', 3);
    }
}