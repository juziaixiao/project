<?php
/**
 * @商圈抽奖
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/9
 * @email:d_w@chunyimail.com
 * @context
 */

namespace app\admin\model;


use app\api\validate\MustbeFile;

use app\admin\validate\Bannernew;
use app\lib\exception\ParameterException;
use think\Model;
use think\Request;

class Banner extends  Model

{
    protected $table='ad_banner';//指定banner表

    public static function list(){
        $list = self::with(['categay'])
            -> where('delete_time','null')
            -> select();
        return $list;
    }

    public function categay(){
        return $this->hasOne('Categay','id','categay_id');
    }

    /**
     * @access public
     * @return mixed
     * @context 执行添加banner
     */
    public static function adddo(){
        $request = new Request();
        $post = $request->post();
       // (new Bannernew())->goCheck();
        if($post){
            //轮播图
            $rule = [
                'banner_img' =>'image',
                'recom_img' => 'image',
                'hotspot_img' => 'image',
            ];
            (new MustbeFile())->goCheck($rule);
            exit;
            if ($request->file('banner_img')) {
                $info1 = request()->file('banner_img')->move(ROOT_PATH . 'public/uploads');
                $banner_img = '/' . 'uploads' . '/' .$info1->getSaveName();
                $banner_img = str_replace('\\', '/', $banner_img);
            }else{
                echo "轮播图未上传";die();
            }
            //推荐图
            $img2 = request()->file('recom_img');
            if ($img2) {
                $info2 = $img2->move(ROOT_PATH . 'public/uploads/');
                $recom_img = '/' . 'uploads' . '/' .$info2->getSaveName();
                $recom_img = str_replace('\\', '/', $recom_img);
            }else{
                echo "推荐图未上传";die();
            }
            //热点图
            $img3 = request()->file('hotspot_img');
            if ($img3) {
                $info3 = $img3->move(ROOT_PATH . 'public/uploads/');
                $hotspot_img = '/' . 'uploads' . '/' .$info3->getSaveName();
                $hotspot_img = str_replace('\\', '/', $hotspot_img);
            }else{
                echo "热点图未上传";die();
            }
            $user = new Banner([
                'categay_id' =>  $post['categay_id'],
                'title'  =>  $post['title'],
                'desc'  =>  $post['desc'],
                'detail'  =>  $post['detail'],
                'phone'  =>  $post['phone'],
                'address'  =>  $post['address'],
                'banner_img'  =>  $banner_img,
                'recom_img'  =>  $recom_img,
                'hotspot_img'  =>  $hotspot_img,
                'url'  =>  $post['url'],
                'create_time' =>  time()
            ]);
            $result = $user->save();
            if($result>0){
                return true;
            }else{
                throw new ParameterException(['errorCode' => 'AD10034', 'msg' => '添加数据失败!']);
            }
        }else{
            throw new ParameterException(['errorCode' => 'AD10033', 'msg' => '获取数据失败!']);
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 修改banenr页
     */
    public static function edit(){
        $request = new Request();
        $get = $request->get();
        if($get){
            $where['id'] = array('eq',$get['id']);
            $list = self::where($where) -> where('delete_time','null') -> find();
            if($list){
                return $list;
            }else{
                throw new ParameterException(['errorCode' => 'AD10036', 'msg' => '卡券数据获取失败！']);
            }
        }else{
            throw new ParameterException(['errorCode' => 'AD10035', 'msg' => '获取卡券信息失败!']);
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 执行修改banenr
     */
    public static function editdo(){
        $request = new Request();
        $post = $request->post();
        (new Bannernew())->goCheck();
        if($post){
            $list = self::where('id',$post['id']) -> where('delete_time','null') ->find();
            if($list){
                //轮播图
                $img1 = request()->file('banner_img');
                if ($img1) {
                    $info1 = $img1->move(ROOT_PATH . 'public/uploads');
                    $banner_img = '/' . 'uploads' . '/' .$info1->getSaveName();
                    $banner_img = str_replace('\\', '/', $banner_img);
                }else{
                    $banner_img = $list['banner_img'];
                }
                //推荐图
                $img2 = request()->file('recom_img');
                if ($img2) {
                    $info2 = $img2->move(ROOT_PATH . 'public/uploads/');
                    $recom_img = '/' . 'uploads' . '/' .$info2->getSaveName();
                    $recom_img = str_replace('\\', '/', $recom_img);
                }else{
                    $recom_img = $list['recom_img'];
                }
                //热点图
                $img3 = request()->file('hotspot_img');
                if ($img3) {
                    $info3 = $img3->move(ROOT_PATH . 'public/uploads/');
                    $hotspot_img = '/' . 'uploads' . '/' .$info3->getSaveName();
                    $hotspot_img = str_replace('\\', '/', $hotspot_img);
                }else{
                    $hotspot_img = $list['hotspot_img'];
                }
                $list->title = $post['ad_id'];
                $list->desc = $post['title'];
                $list->detail = $post['price'];
                $list->phone = $post['start_time'];
                $list->address = $post['end_time'];
                $list->banner_img = $banner_img;
                $list->recom_img = $recom_img;
                $list->hotspot_img = $hotspot_img;
                $list->update_time = time();
                $result = $list->save();
                if($result>0){
                    return true;
                }else{
                    throw new ParameterException(['errorCode' => 'AD10039', 'msg' => '修改数据失败！']);
                }
            }else{
                throw new ParameterException(['errorCode' => 'AD10038', 'msg' => '查询数据失败！']);
            }
        }else{
            throw new ParameterException(['errorCode' => 'AD10037', 'msg' => '数据传输失败！']);
        }
    }

    /**
     * @access public
     * @return mixed
     * @context 获取banner
     */
    public static function getbanner(){
        $list = self::where('delete_time','null') -> select();
        return $list;
    }
}