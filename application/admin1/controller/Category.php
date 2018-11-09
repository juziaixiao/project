<?php
/**
 * @projectname
 * @version 1.0
 * @author 鞠慧宇
 * @date 2018/10/17
 * @email:d_w@chunyimail.com
 * @context admin模块商品分类管理
 */
namespace app\admin\controller;

use app\admin\validate\Categorynew;
use app\api\validate\IDMustBePositiveInt;

class Category extends Basecontroller
{
    /**
     * @access public
     * @context 分类列表
     */
    public  function categoryList(){
       return view();
    }
    /**
     * @access public
     * @context 添加分类
     */
    public  function categoryAdd(){
        $data=[
            'name'=>'',
            'descrption'=>'',
            'topic_img_id'=>'',
        ];
       ( new Categorynew($data))->goCheck();
       return view();
    }
    /**
     * @access public
     * @context 编辑分类
     */
    public function categoryEdit($id=-1){
        (new IDMustBePositiveInt())->goCheck();
    	return view();
    }
    /**
     * @access public
     * @context 删除分类
     */
    public function categoryDel($id=-1){
        (new IDMustBePositiveInt())->goCheck();
        return view();
    }
}