<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/8
 * @email:d_w@chunyimail.com
 * @context 中奖
 */

namespace app\admin\model;

use think\Model;
use think\Request;

class Draw extends Model

{
    protected $table='ad_draw';//指定ad_draw表

    /**
     * @access public
     * @return mixed
     * @context 抽奖列表
     */
    public static function list(){
        $list = self::where('delete_time','null') -> find();
        return $list;
    }

    /**
     * @access public
     * @return mixed
     * @context 执行添加抽奖信息
     */
    public static function adddo(){
        $request = new Request();
        $post = $request->post();
        if($post){
           $draw = new Draw([
                'title' =>  $post['title'],
                'desc'  =>  $post['desc'],
                'detail'  =>  $post['detail'],
                'price'  =>  $post['price'],
                'create_time' =>  time()
            ]);
            $result = $draw->save();
            if($result>0){
                return true;
            }else{
                //添加错误
            }
        }else{
            //获取数据失败
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 修改抽奖页
     */
    public static function edit(){
        $request = new Request();
        $get = $request->get();
        if($get){
            $where['id'] = array('eq',$get['id']);
            $list = self::where($where) -> where('delete_time','null') -> find();
            if($list){
                return $list;
            }else{
                //抽奖数据获取失败！
            }
        }else{
            //获取抽奖信息失败!
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 修改抽奖页
     */
    public static function editdo(){
        $request = new Request();
        $post = $request->post();
        if($post){
            $list = self::where('id',$post['id']) -> where('delete_time','null') ->find();
            if($list){
                $list->title = $post['title'];
                $list->desc = $post['desc'];
                $list->detail = $post['detail'];
                $list->price = $post['price'];
                $list->update_time = time();
                $result = $list->save();
                if($result>0){
                    return true;
                }else{
                    //修改修改点券失败！
                }
            }else{
                //查询数据失败！
            }
        }else{
            //数据传输失败！
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 获取banner
     */
    public static function getbanner(){
        $list = self::where('delete_time','null') -> select();
        return $list;
    }

}