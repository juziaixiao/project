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
//use think\Config;
//use think\Request;
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

}