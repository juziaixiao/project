<?php
namespace app\api\controller;

use app\api\model\Categay as CategayModel;
use app\api\model\Banner as BannerModel;
use think\Controller;

class Index extends Controller{
    /**
     * @access public
     * @param
     * @return
     * @context 首页
     */
    public function index(){
        $categay = CategayModel::getcategay();//获取广告分类
        $banner = BannerModel::getbanner();//获取banner信息
        $this -> assign('categay',$categay);
        return View();
    }


}
