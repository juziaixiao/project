<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/9
 * @email:d_w@chunyimail.com
 * @context
 */

namespace app\admin\Model;

use think\Model;
use think\facade\Session;
use think\Request;
use app\admin\validate\Loginnew;
use app\lib\exception\ParameterException;


class Login extends Model
{

    protected $table = 'ad_admin';

    /**
     * @access public
     * @return
     * @context 执行登录
     */
    public static function dologin()
    {
        (new Loginnew())->goCheck();
        $request = new Request();
        $post = $request->post();
        $username = self::get(['username' => $post['username']]);//查询管理员是否存在
        if ($username) {
            $password = self::get(['username' => $post['username'], 'password' => md5($post['password'])]);
            if ($password) {
                Session::set('username', $post['username']);
                Session::set('password', md5($post['password']));
                return true;
            } else {
                throw new ParameterException(['errorCode' => 'AD10002', 'msg' => '密码错误!']);
            }
        } else {
            throw new ParameterException(['errorCode' => 'AD10001', 'msg' => '该账号不存在!']);
        }
    }

    /**
     * @access public
     * @return
     * @context 修改账号密码页面
     */
    public static function edit()
    {
        $list = self::get(1);
        if($list){
            return $list;
        }else{
            throw new ParameterException(['errorCode' => 'AD10003', 'msg' => '管理员信息查询失败!']);
        }
    }

    /**
     * @access public
     * @return
     * @context 执行修改账号密码
     */
    public static function doedit()
    {
        $request = new Request();
        $post = $request->post();
        if($post['usernaem'] == ''){
            $admin = self::get(1);
            //判断账号是否存在空格
            if (preg_match("/\s/", $post['username'])) {
                throw new ParameterException(['errorCode' => 'AD10005', 'msg' => '管理员账号不能存在空格!']);
            }
            //判断用户是否修改密码
            if ($post['password'] == '') {
                $password = $admin->password;
            } else {
                //判断密码是否存在空格
                if (preg_match("/\s/", $post['password'])) {
                    throw new ParameterException(['errorCode' => 'AD10006', 'msg' => '管理员密码不能存在空格！']);
                } else {
                    $password = md5($post['password']);
                }
            }
            //进行数据更新
            $admin->username = $post['username'];
            $admin->password = $password;
            $con = $admin->save();
            if ($con > 0) {
                return true;
            } else {
                throw new ParameterException(['errorCode' => 'AD10007', 'msg' => '更新管理员数据失败！']);
                //更新管理员数据失败，服务器内部错误！
            }
        }else{
            throw new ParameterException(['errorCode' => 'AD10004', 'msg' => '管理员账号不能为空!']);
        }
    }

}