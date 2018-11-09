<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 12:02
 */

namespace app\admin\validate;


class Bannernew extends Adminvalidate
{
    protected $rule=['name'=>'require','description'=>'require'];

    protected $message = [
        'name' => 'banner不能为空',
        'description' => 'banner描述不为空'
    ];


//    protected $message = [
//        'img_id'=>'require|isPositiveInteger',
//        'key_word'=>'require',
//        'type'=>'require|isPositiveInteger',
//        'banner_id'=>'require|isPositiveInteger'
//    ];
}