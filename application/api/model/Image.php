<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\api\model;

use think\Model;

class Image extends BaseModel
{
    protected $hidden = ['delete_time', 'id', 'from'];

    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}

