<?php
/**
 * @projectname
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
use app\lib\exception\ParameterException;
//use app\admin\validate\SiteValidate;

class Login extends Model{

    protected $table='ad_admin';//指定广告分类表
    /**
     * @access public
     * @return
     * @context 执行登录
     */
    public static function dologin(){
        $request = new Request();
        $post = $request->post();
        $username = self::get(['username'=>$post['username']]);//查询管理员是否存在
//        dump($username);die();
        if($username){
            $password = self::get(['username'=>$post['username'],'password'=>md5($post['password'])]);
            if($password){
                Session::set('username',$post['username']);
                Session::set('password',md5($post['password']));
                return true;
            }else{
                //密码错误
            }
        }else{
            //账号不存在
        }
    }

    /**
     * @access public
     * @return
     * @context 修改账号密码页面
     */
    public static function edit(){
        $list = self::get(1);
        return $list;
    }

    /**
     * @access public
     * @return
     * @context 执行修改账号密码
     */
    public static function doedit(){
        $request = new Request();
        $post = $request->post();
        $admin = self::get(1);
        //判断账号是否存在空格
        if(preg_match("/\s/", $post['username'])){
            //账号不能存在空格
        }
        //判断用户是否修改密码
//        dump($post['password']);die();
        if($post['password']==''){
            $password = $admin -> password;
        }else{
            //判断密码是否存在空格
            if(preg_match("/\s/", $post['password'])){
                //密码不能存在空格！
            }else{
                $password = md5($post['password']);
            }
        }
//        dump($password);die();
        //进行数据更新
        $admin -> username = $post['username'];
        $admin -> password = $password;
        $con = $admin -> save();
        if($con > 0){
            return true;
        }else{
            //更新管理员数据失败，服务器内部错误！
        }

    }

}