<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/9
 * @email:d_w@chunyimail.com
 * @context
 */

namespace app\api\model;

use think\Model;

class Categay extends Model
{
    protected $table = 'ad_categay';

    /**
     * @access public
     * @return
     * @context 获取分类
     */
    public static function getcategay()
    {
        $list = self::where('delete_time', null)->field('id,name,desc')->select();
        return $list;
    }

}