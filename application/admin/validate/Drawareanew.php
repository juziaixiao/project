<?php
/**
 * Created by 丁文爽
 * User: 丁文爽
 * Date: 2018/11/9
 * Time: 14:28
 */

namespace app\admin\validate;


class Drawareanew extends Adminvalidate
{
    protected $rule = [
        'regm_name' => 'require',
        'luck_count' => 'require'
    ];

    protected $message = [
        'regm_name' => '地理位置不能为空！',
        'luck_count' => '中奖人数不能为空！'
    ];

}