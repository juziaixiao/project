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

class Drawlog extends Model

{
    protected $table='ad_user_draw';//中奖纪录表

    /**
     * @access public
     * @return mixed
     * @context 中奖记录列表
     */
    public static function list(){
        $list = self::with(['draw'])
            -> where('delete_time','null')
            -> select();
        return $list;
    }

    public function draw(){
        return $this->hasOne('Draw','id','draw_id');
    }


}