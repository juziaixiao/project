<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/8
 * @email:d_w@chunyimail.com
 * @context 广告分类
 */

namespace app\admin\model;

use think\Model;
use think\Request;
use app\admin\validate\Categaynew;
use app\lib\exception\ParameterException;

class categay extends Model

{
    protected $table = 'ad_categay';//指定广告分类表

    /**
     * @access public
     * @return mixed
     * @context 广告分类列表
     */
    public static function list()
    {
        $where['delete_time'] = NULL;
        $list = self::where($where)->select();
        return $list;
    }

    /**
     * @access public
     * @return mixed
     * @context 执行广告分类添加
     */
    public static function adddo()
    {
        $request = new Request();
        $post = $request->post();
        (new Categaynew())->goCheck();
        $user = new Categay([
            'desc' => $post['desc'],
            'name' => $post['name'],
            'create_time' => time()
        ]);
        $result = $user->save();
        if ($result > 0) {
            return true;
        } else {
            throw new ParameterException(['errorCode' => 'AD10008', 'msg' => '添加广告分类失败!']);
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 修改广告分类页
     */
    public static function edit()
    {
        $request = new Request();
        $get = $request->get();
        if ($get) {
            $where['id'] = array('eq', $get['id']);
            $categay = self::where($where)->find();
            if ($categay) {
                return $categay;
            } else {
                throw new ParameterException(['errorCode' => 'AD10010', 'msg' => '广告分类数据获取失败！']);
            }
        } else {
            throw new ParameterException(['errorCode' => 'AD10009', 'msg' => '获取广告分类id错误!']);
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 执行修改广告分类
     */
    public static function editdo()
    {
        $request = new Request();
        $post = $request->post();
        (new Categaynew())->goCheck();
        if ($post) {
            $categay = self::where('id', $post['id'])->where('delete_time', 'null')->find();
            if ($categay) {
                $categay->desc = $post['desc'];
                $categay->name = $post['name'];
                $categay->update_time = time();
                $result = $categay->save();
                if ($result > 0) {
                    return true;
                } else {
                    throw new ParameterException(['errorCode' => 'AD10013', 'msg' => '修改修改广告分类失败！']);
                }
            } else {
                throw new ParameterException(['errorCode' => 'AD10012', 'msg' => '查询数据失败！']);
            }
        } else {
            throw new ParameterException(['errorCode' => 'AD10011', 'msg' => '数据传输失败！']);
        }
    }

    /**
     * @access public
     * @return mixed
     * @context banner获取分类
     */
    public static function getcategay()
    {
        $list = self::where('delete_time', 'null')->order('create_time', 'desc')->select();
        return $list;
    }

}