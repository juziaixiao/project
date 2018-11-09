<?php
/**
 * @projectname
 * @version 1.0
 * @author 丁文爽
 * @date 2018/10/17
 * @email:d_w@chunyimail.com
 * @context 后台默认控制器
 */
namespace app\admin\controller;
class Order extends Basecontroller
{
    /**
     * @access public
     * @param $id int 用户的id 默认
     * @return
     * @context admin模块默认首页
     */
    public  function orderList(){
       return view();
    }

    public function orderInfo(){

    }

}