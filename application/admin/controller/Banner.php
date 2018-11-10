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
use app\admin\model\Categay as CategayModel;
use app\admin\model\Banner as BannerModel;
use think\Request;

class Banner extends Controller
{
    /**
     * @access public
     * @return mixed
     * @context banner列表
     */
    public function list(){
//        $assign['search'] = '';
//        $search = $request->param('search');
        $list = BannerModel::list();
        $count = count($list);
        $this -> assign('list',$list);
        $this -> assign('count',$count);

        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context banner添加页
     */
    public function add(){
        $list = CategayModel::getcategay();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 执行banner添加
     */
    public function adddo(){
        $list = BannerModel::adddo();
        $this -> success('添加成功！','admin/Banner/list');
    }

    /**
     * @access public
     * @return
     * @context 修改banenr页
     */
    public function edit(){
        $list = BannerModel::edit();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return
     * @context 执行修改广告分类
     */
    public function editdo(){
        $list = BannerModel::editdo();
        $this -> success('修改成功！','admin/Banner/list');
    }

    /**
     * @access public
     * @return
     * @context 执行删除广告分类
     */
    public function del()
    {
        $request = new Request();
        $post = $request->post('id');
        $id = explode(",", $post);
        if(count($id)>0){
            $delResult = BannerModel::Where(['id' => $id])
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

}