<?php
namespace app\api\controller;

use app\api\model\Banner as BannerModel;
use think\Controller;

class Storefront extends Controller{
    /**
     * @access public
     * @param
     * @return
     * @context 店铺详情
     */
    public function index(){
        $browse = BannerModel::dobrowse();//增加访问量
        return View();
    }

    /**
     * @access public
     * @param
     * @return
     * @context 关注店铺
     */
    public function follow(){
        $state = BannerModel::follow();//关注与取消关注操作
        return $state;
    }
}
