<?php
/**
 * @projectname
 * @version 1.0
 * @author 鞠慧宇
 * @date 2018/10/21
 * @email:d_w@chunyimail.com
 * @context admin模块商品分类/添加验证
 */
namespace app\admin\validate;
class Categorynew extends Adminvalidate
{
    /**
     * 全局变量，验证规则
     * @access protected
     * @var array $rule
     */
    protected $rule=[
        'name'=>'require',
        'description'=>'require',
        'topic_img_id'=>'require|isPositiveInteger',
    ];
    /**
     * 全局变量，错误提示信息
     * @access protected
     * @var array $messge
     */
    protected $message = [
        'name' => '分类名称不能为空',
        'description' => '分类描述不能为空',
        'topic_img_id'=>'分类图片不能为空',
    ];
}