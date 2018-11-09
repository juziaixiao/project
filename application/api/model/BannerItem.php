<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\api\model;

use think\Model;

class BannerItem extends BaseModel
{
    protected $hidden = ['id', 'img_id', 'banner_id', 'delete_time'];

    public function img()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
    //
}
