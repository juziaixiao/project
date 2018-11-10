<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/7
 * @email:d_w@chunyimail.com
 * @context 广告分类
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Categay as CategayModel;
use think\Request;

class Categay extends Basecontroller
{
    /**
     * @access public
     * @return mixed
     * @context 广告分类列表
     */
    public function list(){
//        $assign['search'] = '';
//        $search = $request->param('search');
        $list = CategayModel::list();
        $count = count($list);
        $this -> assign('list',$list);
        $this -> assign('count',$count);

//        if ($search) {
//            $assign['search'] = $search;
//        }
//        return view('list', $assign);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 广告分类添加页
     */
    public function add(){
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 执行广告分类添加
     */
    public function adddo(){
        $list = CategayModel::adddo();
        $this -> success('添加成功！','admin/Categay/list');
    }

    /**
     * @access public
     * @return
     * @context 修改广告分类页
     */
    public function edit(){
        $list = CategayModel::edit();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return
     * @context 执行修改广告分类
     */
    public function editdo(){
        $list = CategayModel::editdo();
        $this -> success('修改成功！','admin/Categay/list');
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
            $delResult = CategayModel::Where(['id' => $id])
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