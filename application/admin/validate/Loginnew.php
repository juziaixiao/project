<?php
/**
 * Created by 丁文爽
 * User: 丁文爽
 * Date: 2018/11/3
 * Time: 15:40
 */

namespace app\admin\validate;


class Loginnew extends Adminvalidate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require'
    ];

    protected $message = [
        'username' => '账号不能为空！',
        'password' => '密码不能为空！'
    ];

}