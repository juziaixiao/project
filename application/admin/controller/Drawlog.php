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
use app\admin\model\Drawlog as DrawlogModel;
use think\Request;

class Drawlog extends Basecontroller
{
    /**
     * @access public
     * @return mixed
     * @context 中奖纪录
     */
    public function list(){
        $list = DrawlogModel::list();
        $count = count($list);
        $this -> assign('list',$list);
        $this -> assign('count',$count);
        return view();
    }

    /**
     * @access public
     * @return mixed
     * @context 中奖记录删除
     */
    public function del()
    {
        $request = new Request();
        $post = $request->post('id');
        $id = explode(",", $post);
        if(count($id)>0){
            $delResult = DrawlogModel::Where(['id' => $id])
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