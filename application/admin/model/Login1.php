<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/3
 * @email:d_w@chunyimail.com
 * @context 登陆
 */

namespace app\admin\model;

use think\Model;
use think\facade\Session;
use think\Request;
use app\admin\validate\Loginnew;
use app\lib\exception\ParameterException;


class Login extends Model

{
    protected $table='ab_admin';//指定数据表

    public static function doLogin(){
        $request = new Request();
        $post = $request->post();//获取表单传递的信息

//        (new Loginnew())->goCheck();//进行传值验证
        $username = self::get(['username'=>$post['username']]);//查询管理员是否存在
        if($username){
            //判断密码是否正确
            $admin=self::get(['username'=>$post['username'],'password'=>md5($post['password'])]);
            if($admin){
                //更新最后登录时间
                $user=self::where('id',$admin['id'])->find();
                $user->last_time=time();
                $rel=$user->save();
                if($rel>0){
//                    Session::set('name','thinkphp');
//                    echo Session::get('name');die();



                    //将账号密码存入session中
                    Session::set('username',$post['username']);//将账号存入session
                    Session::set('password',md5($post['password']));//将密码存入session
                    echo "123";die();
                    return true;
                }else{
                    throw new ParameterException(['errcode'=>'AD10003','msg'=>'更新最后登陆时间失败！']);
                }
            }else{
                throw new ParameterException(['errcode'=>'AD10002','msg'=>'密码错误！']);
            }
        }else{
            throw new ParameterException(['errcode'=>'AD10001','msg'=>'该用户不存在！']);
        }
    }
}