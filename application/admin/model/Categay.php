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

class categay extends Model

{
    protected $table='ad_categay';//指定广告分类表

    /**
     * @access public
     * @return mixed
     * @context 广告分类列表
     */
    public static function list(){

        $request = new Request();
        $post = $request->post();
//        if($post['start_time'] != ''){
////            $where = [
////                ['create_time', 'gt', strtotime($post['start_time'])],
////            ];
//            $where['create_time'] = array('gt',strtotime($post['start_time']));
//        }
//        if($post['end_time'] != ''){
//            $where['create_time'] = array('lt',strtotime($post['end_time']));
//        }

        $where['delete_time'] = NULL;
//        dump($where);die();
        $list = self::where($where)-> select();
        return $list;
    }

    /**
     * @access public
     * @return mixed
     * @context 执行广告分类添加
     */
    public static function adddo(){
        $request = new Request();
        $post = $request->post();
//        dump($post['name']);die();
        //这里需要做一个数据验证

        $user = new Categay([
            'desc' =>  $post['desc'],
            'name'  =>  $post['name'],
            'create_time' =>  time()
        ]);
        $result = $user->save();
        if($result>0){
            return true;
        }else{
            //添加错误
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 修改广告分类页
     */
    public static function edit(){
        $request = new Request();
        $get = $request->get();
        if($get){
            $where['id'] = array('eq',$get['id']);
            $categay = self::where($where)->find();
            if($categay){
                return $categay;
            }else{
                //广告分类数据获取失败！
            }
        }else{
            //获取广告分类id错误!
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 执行修改广告分类
     */
    public static function editdo(){
        $request = new Request();
        $post = $request->post();
//        dump($post);die();
        if($post){
            $categay = self::where('id',$post['id']) -> where('delete_time','null') ->find();
            if($categay){
                $categay->desc = $post['desc'];
                $categay->name = $post['name'];
                $categay->update_time = time();
                $result = $categay->save();
                if($result>0){
                    return true;
                }else{
                    //修改修改广告分类失败！
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