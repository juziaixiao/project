<?php
/**
 * @商圈抽奖
 * @Create 丁文爽
 * @Date 2018/11/9
 * @Email:d_wo@chunyimail.com
 * @Context  验证登录
 */

namespace app\admin\controller;

use think\Controller;
use think\facade\Session;

class Basecontroller extends Controller
{
    public function __construct()
    {

        parent::__construct();
        $username = Session::get('username');
        $password = Session::get('password');

        if (!$username || !$password) {
            $this->error('登陆', 'admin/login/login', 3);
        }
    }


}