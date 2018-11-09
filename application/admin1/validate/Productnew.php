<?php
/**
 * @projectname
 * @version 1.0
 * @author 鞠慧宇
 * @date 2018/10/21
 * @email:d_w@chunyimail.com
 * @context admin模块商品/添加验证
 */
namespace app\admin\validate;
#集成admin模块验证基类
class Productnew extends Adminvalidate
{
    /**
     * 全局变量，验证规则
     * @access protected
     * @var array $rule
     */
    protected  $rule=[
        'name'=>'require',
        'stock'=>'require|isPositiveInteger',
        'price'=>'require|float',
        'Category_id'=>'require|isPositiveInteger',
        'main_img_url'=>'require',
        'from'=>'require|isPositiveInteger',
        'summary'=>'require',
        'img_id'=>'require|isPositiveInteger',
    ];
    /**
     * 全局变量，错误提示信息
     * @access protected
     * @var array $messge
     */
    protected  $messge=[
        'name'=>'商品名称未填写',
        'stock'=>'商品库存未填写',
        'price'=>'商品价格未填写或者格式不正确',
        'Category_id'=>'商品分类未填写或者格式不正确',
        'main_img_url'=>'商品图片地址未填写',
        'from'=>'商品图片来源未填写或者格式不正确',
        'summary'=>'商品介绍未填写',
        'img_id'=>'商品图片id未填写或者格式不正确',
    ];
}