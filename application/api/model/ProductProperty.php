<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\api\model;


class ProductProperty extends BaseModel
{
    protected $hidden=['product_id', 'delete_time', 'id'];
}