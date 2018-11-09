<?php
/**
 * Created by 丁文爽
 * User: 丁文爽
 * Date: 2018/11/6
 * Time: 13:45
 */

namespace app\admin\model;

use think\Model;
use think\facade\Request;

class Common extends Model

{
    /**
     * @access public
     * @return
     * @context 公共添加方法
     */
    public function insert($table,$field){
        $table = new $table;
        $result = $table -> saveAll($field);
        return $result;
    }

    /**
     * @access public
     * @return
     * @context 公共单查询方法
     */
    public function find($table,$where,$order){
        $table = new $table;
        $result = $table::where($where) -> order($order) -> find();
        return $result;
    }

    /**
     * @access public
     * @return
     * @context 公共多查询方法
     */
//    public static function getDofollow($uid){
    public static function select($table,$where,$order,$limit){
//        dump($table);die();
//        protected $table = $table;
//        $table = new $table;
        $request = $table -> where($where) -> order($order) -> limit($limit) -> select();
        return $request;
    }

    /**
     * @access public
     * @return
     * @context 公共删除方法
     */
    public function delte($table,$where){
        $table = new $table;
        $result = $table -> where($where) -> delete();
        return $result;
    }

}