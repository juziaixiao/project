<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/8
 * @email:d_w@chunyimail.com
 * @context 中奖区域设置
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Drawarea as DrawareaModel;
use app\admin\model\Draw as DrawModel;
use think\Request;

class Drawarea extends Basecontroller
{
    /**
     * @access public
     * @return mixed
     * @context 中奖区域列表
     */
    public function list(){
        $list = DrawareaModel::list();
        $count = count($list);
        $this -> assign('list',$list);
        $this -> assign('count',$count);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 中奖区域添加页
     */
    public function add(){
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 执行中奖区域添加
     */
    public function adddo(){
        $list = DrawareaModel::adddo();
        $this -> success('添加成功！','admin/Drawarea/list');
    }

    /**
     * @access public
     * @return
     * @context 修改中奖区域页
     */
    public function edit(){
        $list = DrawareaModel::edit();
        $this -> assign('list',$list);
        return view();
    }

    /**
     * @access public
     * @return
     * @context 执行修改中奖区域
     */
    public function editdo(){
        $list = DrawareaModel::editdo();
        $this -> success('修改成功！','admin/Drawarea/list');
    }

    /**
     * @access public
     * @return
     * @context 执行删除中奖区域
     */
    public function del()
    {
        $request = new Request();
        $post = $request->post('id');
        $id = explode(",", $post);
        if(count($id)>0){
            $delResult = DrawareaModel::Where(['id' => $id])
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