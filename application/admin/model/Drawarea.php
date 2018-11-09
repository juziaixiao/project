<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/3
 * @email:d_w@chunyimail.com
 * @context 登陆
 */

namespace app\admin\model;

use think\Model;
use think\facade\Session;
use think\Request;

use app\lib\exception\ParameterException;
use think\Db;

class Drawarea extends Model

{
    protected $table='ad_draw_area';//指定中奖区域表

    /**
     * @access public
     * @return mixed
     * @context 中奖区域列表
     */
    public static function list(){
        $request = new Request();
        $post = $request->post();
//        dump($post);die();
//        if($post || $post['start_time']!='' || $post['end_time']!=''){
//            $where['create_time'] = array('>',strtotime($post['start_time']));
//            $where['create_time'] = array('<',strtotime($post['end_time']));
//        }
//        $map['delete_time']  = array('exp',' is NULL');
//        $where['delete_time'] = array('exp','is NULL');
//        $list = self::where($where) -> order('create_time','desc') -> select();
//        $list = self::where('delete_time','null')-> order('create_time','desc') -> select();

//        $list = self::with(['draw'])
//            -> where('delete_time','null')
//            -> select();
        $list = self::where('delete_time','null')->select();

//        dump($list);die();
        return $list;
    }

    public function draw(){
        return $this->hasOne('Draw','id','draw_id');
    }

    /**
     * @access public
     * @return mixed
     * @context 执行中奖区域添加
     */
    public static function adddo(){
        $request = new Request();
        $post = $request->post();

        //这里需要做一个数据验证

        $draw = new Drawarea([
            'regm_name' =>  $post['regm_name'],
            'luck_count'  =>  $post['luck_count'],
            'create_time' =>  time()
        ]);
        $result = $draw->save();
        if($result>0){
            return true;
        }else{
            //添加错误
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 修改中奖区域页
     */
    public static function edit(){
        $request = new Request();
        $get = $request->get();
        if($get){
            $where['id'] = array('eq',$get['id']);
            $drawarea = self::where($where)->find();
            if($drawarea){
                return $drawarea;
            }else{
                //抽奖区域数据获取失败！
            }
        }else{
            //获取抽奖区域id错误!
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 执行修改中奖区域
     */
    public static function editdo(){
        $request = new Request();
        $post = $request->post();
        if($post){
            $drawarea = self::where('id',$post['id']) -> where('delete_time','null') ->find();
            if($drawarea){
                $drawarea->regm_name = $post['regm_name'];
                $drawarea->luck_count = $post['luck_count'];
                $drawarea->update_time = time();
                $result = $drawarea->save();
                if($result>0){
                    return true;
                }else{
                    //修改中奖区域失败！
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
     * @context banner获取分类
     */
    public static function getcategay(){
        $list = self::where('delete_time','null')-> order('create_time','desc') -> select();
        return $list;
    }

}