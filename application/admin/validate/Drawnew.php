<?php
/**
 * Created by 丁文爽
 * User: 丁文爽
 * Date: 2018/11/9
 * Time: 14:19
 */

namespace app\admin\validate;


class Drawnew extends Adminvalidate
{
    protected $rule = [
        'title' => 'require',
        'desc' => 'require',
        'detail' => 'require',
        'price' => 'require'
    ];

    protected $message = [
        'title' => '标题不能为空！',
        'desc' => '简介不能为空！',
        'detail' => '详情不能为空！',
        'price' => '中奖奖品不能为空！'
    ];

}