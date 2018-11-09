<?php
/**
 * Created by Kenneth Luff.
 * Author: Kenneth Luff
 * Email: kennethluff@outlook.com
 */

namespace app\api\model;

use think\Model;

class UserAddress extends BaseModel
{
   protected $hidden =['id', 'delete_time', 'user_id'];

}


