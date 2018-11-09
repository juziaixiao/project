<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\api\controller\v1;
use app\lib\exception\MissException;

use think\Controller;
use think\Exception;

/**
 * MISS路由，当全部路由没有匹配到时
 * 将返回资源未找到的信息
 * @throws Exception
 */
class Miss extends Controller
{
    public function miss()
    {
        //throw new MissException();

        throw new MissException();
    }
}