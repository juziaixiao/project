<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/8
 * @email:d_w@chunyimail.com
 * @context 卡券
 */

namespace app\admin\model;

use think\Model;
use think\Request;
use app\admin\model\Draw as DrawModel;

class Coupons extends  Model

{
    protected $table='ad_coupons';//指定ad_coupons表

    /**
     * @access public
     * @return mixed
     * @context 卡券列表
     */
    public static function list(){
        $list = self::with(['banner'])
            -> where('delete_time','null')
            -> select();
        return $list;
    }

    public function banner(){
        return $this->hasOne('Banner','id','ad_id');
    }

    /**
     * @access public
     * @return mixed
     * @context 执行添加卡券
     */
    public static function adddo(){
        $request = new Request();
        $post = $request->post();
        if($post){
            if($post['ad_id']) {//判断是否存在banner
                $user = new Coupons([
                    'ad_id' =>  $post['ad_id'],
                    'title' => $post['title'],
                    'price' => $post['price'],
                    'state' => 1,
                    'pass' => time().rand(1000,9999),
                    'start_time' => $post['start_time'],
                    'end_time' => $post['end_time'],
                    'create_time' => time()
                ]);
                $result = $user->save();
                if($result>0){
                    return true;
                }else{
                    //添加错误
                }
            }else{
                //没有banner 请先添加banner
            }
        }else{
            //获取数据失败
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 修改卡券页
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
                //卡券数据获取失败！
            }
        }else{
            //获取卡券信息失败!
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 执行修改卡券
     */
    public static function editdo(){
        $request = new Request();
        $post = $request->post();
        if($post){
            $list = self::where('id',$post['id']) -> where('delete_time','null') ->find();
            if($list){
                $list->ad_id = $post['ad_id'];
                $list->title = $post['title'];
                $list->price = $post['price'];
                $list->start_time = $post['start_time'];
                $list->end_time = $post['end_time'];
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
     * @context 用户卡券
     */
    public static function userlist(){
        $list = self::with(['banner'])
            -> where('delete_time','null')
            -> select();
        return $list;
    }

//    public function banner(){
//        return $this->hasOne('Banner','id','ad_id');
//    }






}