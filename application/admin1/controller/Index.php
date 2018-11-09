<?php
/**
 * @projectname
 * @version 1.0
 * @author 鞠慧宇
 * @date 2018/10/17
 * @email:juziaixiao@chunyimail.com
 * @context 后台默认控制器
 */
namespace app\admin\controller;
use think\Config;
use think\Request;
use think\Session;

class Index extends Basecontroller
{
    /**
     * @access public
     * @param $id int 用户的id 默认
     * @return
     * @context admin模块默认首页
     */
    public  function index(){

    return view();
}



    public function uploader(){

    }

    public function adError(){
        $info=Request::instance()->param();
        //dump($info);
        return view('aderror',array('msg'=>$info['msg'],'errorcode'=>$info['errorcode'],'code'=>$info['code']));
    }
}