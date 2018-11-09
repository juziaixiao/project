<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 10:23
 */

namespace app\admin\validate;


class BanneritemNew extends Adminvalidate
{
    protected $rule=[
        'img_id'=>'require|isPositiveInteger',
        'key_word'=>'require',
        'type'=>'require|isPositiveInteger',
        'banner_id'=>'require|isPositiveInteger'];
}