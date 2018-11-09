<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 9:34
 */

namespace app\admin\model;


use app\lib\exception\Errorexception;
use think\Db;
use think\Model;
use think\Request;
use app\admin\validate\Bannernew;
class Banner extends  Model

{
    public function items(){
      return   $this->hasMany('BannerItem','banner_id','id');
    }

    public static function getBannerlist(){
        $re= self::with(['items'])->select();
        return $re;
    }

    public static function  insertBanner($data){

        $data = [
            'name' => $data['name'], //名字
            'description' => $data['description'] //描述
        ];
        (new Bannernew($data))->goCheck();

        $banner = Db::name('banner')->insert($data);
        if($banner > 0){
           return 'succese';
        }else{

            $exception=new Errorexception([
                    'errorcode'=>'AD20010',
                    'msg'=>'添加banner失败，服务器内部错误']
            );
            throw $exception;
        }
     }





}