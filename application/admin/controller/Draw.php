<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/8
 * @email:d_w@chunyimail.com
 * @context 中奖
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Draw as DrawModel;
use app\admin\model\Drawlog as DrawlogModel;
use think\Request;

class Draw extends Basecontroller
{
    /**
     * @access public
     * @return mixed
     * @context 中奖列表
     */
    public function list(){
        $list = DrawModel::list();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 抽奖添加页
     */
    public function add(){
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 执行添加抽奖信息
     */
    public function adddo(){
        $list = DrawModel::adddo();
        $this -> success('添加成功！','admin/Draw/list');
    }

    /**
     * @access public
     * @return
     * @context 修改抽奖页
     */
    public function edit(){
        $list = DrawModel::edit();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return
     * @context 执行修改广告分类
     */
    public function editdo(){
        $list = DrawModel::editdo();
//        $log = DrawlogModel::dellog();


        $this -> success('修改成功！','admin/Draw/list');
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
            $delResult = DrawModel::Where(['id' => $id])
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