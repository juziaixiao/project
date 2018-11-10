<?php
/**
 * @爱帮合伙人
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/3
 * @email:d_w@chunyimail.com
 * @context 后台默认控制器
 */
namespace app\admin\controller;
use think\Controller;
use think\facade\Request;

//use think\Config;

//use think\Session;

class Index extends Controller
{
    /**
     * @access public
     * @param $id int 用户的id 默认
     * @return
     * @context admin模块默认首页
     */
    public function index(){
        return view();

    }


    public function adError(){
        header("Content-type: text/html; charset=utf-8");
        $info = Request::instance()->param();
        return view('aderror',array('msg'=>$info['msg'],'errorcode'=>$info['errorcode'],'code'=>$info['code']));
    }


    public function loginerror(){
        header("Content-type: text/html; charset=utf-8");
        $info = Request::instance()->param();
        return view('loginerror',array('msg'=>$info['msg'],'errorcode'=>$info['errorcode'],'code'=>$info['code']));
    }

}