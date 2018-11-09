<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/7
 * @email:d_w@chunyimail.com
 * @context banner
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Banner as BannerModel;
use app\admin\model\Coupons as CouponsModel;
use app\admin\model\Draw as DrawModel;
use think\Request;

class Coupons extends Controller
{
    /**
     * @access public
     * @return mixed
     * @context 卡券列表
     */
    public function list(){
        $list = CouponsModel::list();
        $count = count($list);
        $this -> assign('list',$list);
        $this -> assign('count',$count);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 卡券添加页
     */
    public function add(){
        $list = BannerModel::getbanner();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 执行卡券添加
     */
    public function adddo(){
        $list = CouponsModel::adddo();
        $this -> success('添加成功！','admin/coupons/list');
    }

    /**
     * @access public
     * @return
     * @context 修改广告分类页
     */
    public function edit(){
        $list = CouponsModel::edit();
        $banner = DrawModel::getbanner();
        $this -> assign('list',$list);
        $this -> assign('banner',$banner);
        return view();
    }

    /**
     * @access public
     * @return
     * @context 执行修改卡券
     */
    public function editdo(){
        $list = CouponsModel::editdo();
        $this -> success('修改成功！','admin/Coupons/list');
    }

    /**
     * @access public
     * @return
     * @context 执行删除点券
     */
    public function del()
    {
        $request = new Request();
        $post = $request->post('id');
        $id = explode(",", $post);
        if(count($id)>0){
            $delResult = CouponsModel::Where(['id' => $id])
                ->update(['delete_time' => time()]);
            if($delResult){
                return json(['code' => 200]);
            }else{
                return json(['code' => 500, 'errmsg' => '服务器错误删除失败']);
            }
        }else{
            return json(['code' => 500, 'errmsg' => '参数错误']);
        }
    }

    /**
     * @access public
     * @return
     * @context banner
     */
    public function userlist(){
        $list = CouponsModel::userlist();
        $count = count($list);
        $this -> assign('list',$list);
        $this -> assign('count',$count);
        return view();
    }

}