<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
class Index extends controller
{
    public function index()
    {
        return view();
    }

    public function hello($name = 'ThinkPHP5')
    {

        return 'hello,' . $name;

    }


}
