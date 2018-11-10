<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/9
 * @email:d_w@chunyimail.com
 * @context 关注与取消关注
 */

namespace app\api\model;

use think\Model;
use think\Request;

class Follow extends Model
{
    protected $table = 'ad_user_follow';

    /**
     * @access public
     * @return
     * @context 关注和取消关注操作
     */
    public static function follow()
    {
        $request = new Request();
        $post = $request->post();
        if($post){
            //$post['state']的值 1关注操作 2取消关注
            if($post['state'] == 1){
                $follow = new Follow([
                    'ad_id'  =>  $post['ad_id'],//店铺id
                    'user_id' =>  $post['user_id'],//用户id
                    'create_time' =>  time(),//创建时间
                ]);
                $state = $follow->save();
                if($state>0){
                    return true;
                }else{
                    //关注失败！
                }
            }else{
                $where['ad_id'] = $post['ad_id'];
                $where['user_id'] = $post['user_id'];
                $follow = self::where($where)->find();
                if($follow){
                    $follow->delete_time    = time();
                    $state = $follow->save();
                    if($state > 0){
                        return true;
                    }else{
                        //取消关注失败
                    }
                }else{
                    //获取取消关注信息失败！
                }
            }
        }else{
            //获取信息失败！
        }
    }

}