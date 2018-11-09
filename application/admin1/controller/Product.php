<?php
/**
 * @projectname
 * @version 1.0
 * @author 丁文爽
 * @date 2018/10/17
 * @email:d_w@chunyimail.com
 * @context 后台默认控制器
 */
namespace app\admin\controller;
use app\admin\validate\Productnew;
use app\lib\exception\ParameterException;

class Product extends Basecontroller
{
    /**
     * @access public
     * @return
     * @context
     */
    public  function productList(){
       return view();
    }

    /**
     * @access public
     * @return
     * @context 添加商品
     */
    public  function productAdd(){
        //admin\validate\Productnew.php声明验证规则和提示信息--》在这里用
        if($_POST){
            $data=[
                'name'=>$_POST['name'],
                'stock'=>$_POST['stock'],
                'price'=>$_POST['price'],
                'Category_id'=>$_POST['Category_id'],
                'main_img_url'=>$_POST['main_img_url'],
                'from'=>$_POST['from'],
                'summary'=>$_POST['summary'],
                'img_id'=>$_POST['img_id'],
            ];
            (new Productnew($data))->goCheck();
        }
        //或者这样也行
        if(!$_POST['name']){
            $exception=new ParameterException(
                ['errorcode'=>'AD00001',//error.code.txt 文件中说明代码意思
                    'msg'=>'提交数据不完整或者格式不正确']);
            throw $exception;
        }

       return view();
    }


    public function productEdit(){
    	return view();
    }


    public  function productCategory(){
       return view();
    }



    public  function productCategoryAdd(){
       return view();
    }



    public  function productCategoryEdit(){
       return view();
    }
}