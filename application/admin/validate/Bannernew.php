<?php
/**
 * Created by 丁文爽
 * User: 丁文爽
 * Date: 2018/11/9
 * Time: 14:56
 */

namespace app\admin\validate;


class Bannernew extends Adminvalidate
{
    protected $rule = [
        'categay_id' => 'require',
        'title' => 'require',
        'desc' => 'require',
        'phone' => 'require',
        'address' => 'require',
        'url' => 'require',
        'detail' => 'require'
    ];

    protected $message = [
        'categay_id' => '分类不能为空！',
        'title' => '标题不能为空！',
        'desc' => '简介不能为空！',
        'phone' => '电话不能为空！',
        'address' => '位置不能为空！',
        'url' => '视频路径不能为空！',
        'detail' => '详情不能为空！'
    ];

}