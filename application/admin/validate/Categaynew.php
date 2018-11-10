<?php
/**
 * Created by 丁文爽
 * User: 丁文爽
 * Date: 2018/11/9
 * Time: 13:38
 */

namespace app\admin\validate;


class Categaynew extends Adminvalidate
{
    protected $rule = [
        'name' => 'require',
        'desc' => 'require'
    ];

    protected $message = [
        'name' => '名称不能为空！',
        'desc' => '简介不能为空！'
    ];

}