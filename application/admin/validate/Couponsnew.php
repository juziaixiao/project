<?php
/**
 * Created by 丁文爽
 * User: 丁文爽
 * Date: 2018/11/9
 * Time: 13:54
 */

namespace app\admin\validate;


class Couponsnew extends Adminvalidate
{
    protected $rule = [
        'ad_id' => 'require',
        'title' => 'require',
        'price' => 'require',
        'start_time' => 'require',
        'end_time' => 'require'
    ];

    protected $message = [
        'ad_id' => 'banner不能为空！',
        'title' => '卡券标题不能为空！',
        'price' => '卡券金额不能为空！',
        'start_time' => '开始时间不能为空！',
        'end_time' => '结束时间不能为空！'
    ];

}