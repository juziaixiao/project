<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/3
 * @email:d_w@chunyimail.com
 * @context 抽奖设置
 */

namespace app\admin\model;

use think\Model;
use think\Request;
use app\admin\validate\Drawareanew;
use app\lib\exception\ParameterException;

class Drawarea extends Model

{
    protected $table='ad_draw_area';//指定中奖区域表

    /**
     * @access public
     * @return mixed
     * @context 中奖区域列表
     */
    public static function list(){
        $list = self::where('delete_time','null')->select();
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
        (new Drawareanew())->goCheck();
        $draw = new Drawarea([
            'regm_name' =>  $post['regm_name'],
            'luck_count'  =>  $post['luck_count'],
            'create_time' =>  time()
        ]);
        $result = $draw->save();
        if($result>0){
            return true;
        }else{
            throw new ParameterException(['errorCode' => 'AD10027', 'msg' => '添加数据失败!']);
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
                throw new ParameterException(['errorCode' => 'AD10029', 'msg' => '修改抽奖数据失败!']);
            }
        }else{
            throw new ParameterException(['errorCode' => 'AD10028', 'msg' => '获取抽奖数据失败!']);
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
        (new Drawareanew())->goCheck();
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
                    throw new ParameterException(['errorCode' => 'AD10032', 'msg' => '修改中奖区域失败！']);
                    //修改中奖区域失败！
                }
            }else{
                throw new ParameterException(['errorCode' => 'AD10031', 'msg' => '查询数据失败！']);
            }
        }else{
            throw new ParameterException(['errorCode' => 'AD10030', 'msg' => '数据传输失败！']);
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