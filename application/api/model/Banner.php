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
use think\Request;

class Banner extends Model
{
    protected $table = 'ad_banner';

    /**
     * @access public
     * @return
     * @context 获取banner信息
     */
    public static function getbanner()
    {
        $request = new Request();
        $post = $request->post();
        if ($post) {
            $where['categay_id'] = array('eq',$post['categay_id']);
            $where['delete_time'] = NULL;
        } else {
            $where['delete_time'] = NULL;
        }
        $list = self::where($where)->select();
//        dump($list);
//        die();
        return $list;
    }

    /**
     * @access public
     * @return
     * @context 增加访问量
     */
    public static function dobrowse(){
        $request = new Request();
        $post = $request->post();
        $post['id'] = 2;
        //条件
        $where['delete_time'] = NULL;
        $where['id'] = array('id',$post['id']);
        //字段
        $field = ('id,browse_num');
        //获取店铺信息
        $banner = self::where($where)->field($field)->find();
        if($banner){
            $banner->browse_num = $banner['browse_num'] + 1;
            $result = $banner -> save();
            if($result>0){
                return true;
            }else{
                //更新访问量失败！
            }
        }else{
            //获取店铺信息失败！
        }
    }



}