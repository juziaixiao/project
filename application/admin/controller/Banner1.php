<?php
/**
 * @广告
 * @version 1.0
 * @author 丁文爽
 * @date 2018/11/7
 * @email:d_w@chunyimail.com
 * @context banner
 */
namespace app\admin\controller;

use app\lib\exception\Errorexception;
use app\lib\exception\Imageexception;
use app\lib\exception\MissException;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessMessage;


use app\admin\model\Banner as Bannermodel;
use think\Request;
use think\Session;

class Banner extends Controller
{
    /**
     * @access public
     * @param 
     * @return 
     * @context banner类型展示
     */
    public function bannerList(){
        // header("Content-type: text/html; charset=utf-8");

     $banner=Bannermodel::getBannerlist();

dump($banner);
//        $this->assign("banner", $banner);
//        return view();
    }

    /**
     * @access public
     * @param 
     * @return 
     * @context banner类型添加
     */
    public function bannerAdd(){

        if($this->request->isPost()){

            $post = Request::instance()->post();
            $data = [
                'name' => $post['name'], //名字
                'description' => $post['description'] //描述
            ];
            (new Bannernew($data))->goCheck();

            $banner = Db::name('banner')->insert($data);
            if($banner > 0){
               // $this -> success("添加成功！");
                $exception=new SuccessMessage([
                        'errorcode'=>'AD20010',
                        'msg'=>'添加成功']
                );
                throw $exception;
            }else{

                $exception=new Errorexception([
                    'errorcode'=>'AD20010',
                    'msg'=>'添加banner失败，服务器内部错误']
                );
            throw $exception;
            }
        }else{
            return view();
        }
    }

    /**
     * @access public
     * @param 
     * @return 
     * @context banner类型删除
     */
    public function bannerDel(){
        $id = $this->request->param("id");

        if(!$id){
            return json(['code'=>404,'msg'=>'未获取信息']);
        }else{
            $res = Db::name('banner')->where('id',$id)->update(['delete_time'=>time()]);
            if($res){
                return json(['code'=>200,'msg'=>'删除成功']);
            }else{
                return json(['code'=>404,'msg'=>'删除失败']);
            }
        }
    }


    /**
     * @access public
     * @param 
     * @return 
     * @context banner类型修改
     */
    public function bannerEdit(){
        if($this->request->isPost()){
            $post = Request::instance()->post();
            if($post){
                $data = [
                    'name' => $post['name'], //名字
                    'description' => $post['description'], //描述
                    'update_time' => time() //修改时间
                ];
                (new Bannernew($data))->goCheck();
                $banner = Db::name('banner')->where('id',$post['id'])->update($data);
                if($banner > 0){
                    $this -> success("修改成功!");

                }else{
                    $exception=new Errorexception([
                            'errorcode'=>'AD20011',
                            'msg'=>'修改banner失败，服务器内部错误']
                    );
                    throw $exception;

                }
            }else{
                ( new IDMustBePositiveInt())->goCheck();
            }
        }else{
            $id = intval($this->request->param("id"));
             ( new IDMustBePositiveInt( $id))->goCheck();
            $db = Db::name('banner');
            $banner = $db -> where('id',$id) -> find();
            if(empty($banner)){
                $exception=new MissException(
                    ['code'=>'AD20000',
                        'msg'=>'请求的banner不存在']
                );
                throw $exception;
            }
            $this -> assign("banner",$banner);
            return view();
        }
    }

    /**
     * @access public
     * @param 
     * @return 
     * @context banner详情展示
     */
    public function bannerDet()
    {
//        header("Content-type: text/html; charset=utf-8");
        $id = intval($this->request->param("id"));
        ( new IDMustBePositiveInt())->goCheck();
        Session::set('bannerDetAddId',$this->request->param("id"));
        //将轮播类型id存入session中

        $defind = [
            'b.name',
            'b.description',
            'b.delete_time',
            'b.update_time update_time1',
            'bo.*',
            'bo.id bid',
            'bo.delete_time bo_delete_time',
            'm.*'
        ];
        $db = Db::name('banner');
        $banner = $db -> alias('b')
            -> join('banner_item bo','b.id = bo.banner_id','LEFT')
            -> join('image m','bo.img_id = m.id','LEFT')
            -> where('bo.delete_time','null')
            -> where('m.delete_time','null')
            -> where('bo.banner_id',$id) ->field($defind) ->  select();
        // echo DB::name('banner')->getlastsql();
        // echo "<pre>";print_r($banner);die();
        $this -> assign("banner", $banner);
        return view();
    }

    /**
     * @access public
     * @param 
     * @return 
     * @context 执行添加banner_item某条详情信息
     */
    public function bannerDetAdd(){
        // session(null);
        // var_dump(Session::get());die();
        if($this->request->isPost()){
            $post = Request::instance()->post();//获取传递数据
            if($post){

                $file = request()->file('image');
                if(true !== $this->validate(
                        ['image' => $file],
                        ['image' => 'require|image'])){
                    $exception=new Imageexception();
                    throw $exception;
                }else{
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
                    if($info){
                        //存入相对路径/images/日期/文件名
                        $url = DS . 'images' . DS . $info->getSaveName();
                    }else{
                        // 上传失败获取错误信息
                        $exception=new Imageexception(
                            ['errorcode'=>'AD30002',
                                'msg'=>$file->getError()]);
                        throw $exception;

                    }
                }

                //处理表单数据(准备添加图片)
                $data = [
                    'url' => $url,//图片路径
                    'from' => 1,//图片来源(默认本地)
                    'delete_time' => null,
                    'update_time' => null
                ];
                $addImage = Db::name('image') -> insert($data);//执行插入数据
                if($addImage){
                    $img_id = Db::name('image') -> getLastInsID();//插入的数据的自增id
                    if(!$img_id){

                        $exception=new Imageexception(
                            ['errorcode'=>'AD30003',
                                'code'=>204,
                                'msg'=>'添加图片失败']);
                        throw $exception;
                    }else{
                        //处理表单数据(准备添加banner详情信息)
                        $data1 = [
                            'delete_time' => null,
                            'update_time' => null,
                            'img_id' => $img_id,//图片id
                            'key_word' => $post['key_word'],//关键字
                            'type' => $post['type'],//跳转类型
                            'banner_id' => session::get('bannerDetAddId'),//轮播类型
                        ];
                        $addBannerDet = Db::name('banner_item') -> insert($data1);//执行插入数据
                        if($addBannerDet){
                            $this->success('添加成功！');
                        }else{

                            $exception=new Errorexception(
                                ['errorcode'=>'AD20001',
                                    'msg'=>'添加banner_item失败']);
                            throw $exception;
                        }
                    }
                }else{
                    $exception=new Errorexception(
                        ['errorcode'=>'AD30003',
                            'code'=>204,
                            'msg'=>'添加图片失败，服务器内部错误！']);
                    throw $exception;
                } 
            }else{
                $exception= new ParameterException();
                throw $exception;
            }
        }else{
            return view();
        }
    }

    /**
     * @access public
     * @param 
     * @return
     * @context 执行修改banner_item某条详情信息
     */
    public function bannerDetEdit(){
        if($this->request->isPost()){
            $post = Request::instance()->post();//获取传递数据

            if($post){
                $file = request()->file('url');

                if(true !== $this->validate(['image' => $file], ['image' => 'require|image'])){
                    $data = [
                        'key_word' => $post['key_word'],//关键字
                        'type' => $post['type'],//跳转类型
                        'update_time' => time()
                    ];


                    $banner_item = Db::name('banner_item') -> where('id',Session::get("bannerDetEditId")) -> update($data);
                    if($banner_item > 0){
                        $this -> success("数据更新成功！");
                    }else{
                       $ex= new Errorexception([
                           'msg'=>'服务器内部错误，数据更新失败',
                           'errorcode'=>'AD20002',]);

                        throw $ex;
                    }
                }else{//判断如果有文件上传
                   $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
                   if($info){
                        //存入相对路径/images/日期/文件名
                        $url = DS . 'images' . DS . $info->getSaveName();
                    }else{
                        // 上传失败获取错误信息
                        echo $file->getError();
                    }
                    //处理表单数据(准备添加图片)
                    $data = [
                        'url' => $url,//图片路径
                        'update_time' => time()
                    ];
                    $img_id = Db::name('banner_item') -> where('id',Session::get("bannerDetEditId")) -> find()['img_id'];  //获取图片id
                    $img = Db::name('image') -> where('id',$img_id) -> update($data);
                    if($img > 0){
                        $data1 = [
                            'key_word' => $post['key_word'],//关键字
                            'type' => $post['type'],//跳转类型
                            'update_time' => time()
                        ];
                        $banner_item = Db::name('banner_item') -> where('id',Session::get("bannerDetEditId")) -> update($data1);
                        if($banner_item > 0){
                            $this -> success("数据更新成功！");
                        }else{
                            $ex= new Errorexception([
                                'msg'=>'服务器内部错误，
                                banneritem更新失败',
                                'errorcode'=>'AD20002',]);

                            throw $ex;
                        }
                    }else{
                        $ex= new Errorexception(
                            ['msg'=>'服务器内部错误，banneritem更新失败',
                                'errorcode'=>'AD30004',
                                'code'=>500]);
                        throw $ex;
                    }
                }
            }else{
                $exception= new MissException();
                throw $exception;
                // $this -> error("数据传输失败！");
            }
        }else{
            $id = intval($this->request->param("id"));
            ( new IDMustBePositiveInt())->goCheck();
            Session::set('bannerDetEditId',$this->request->param("id"));//将数据详情id存入session中
            $db = Db::name('banner_item');
            $banner = $db -> alias('b')
                -> join('image m','b.img_id = m.id','LEFT')
                -> where('m.delete_time','null')
                -> where('b.id',$id)
                -> find();
            if(empty($banner)){
                $exception=new MissException(
                    ['code'=>'AD20000',
                        'msg'=>'请求的banner不存在']
                );
                throw $exception;
            }
            $this -> assign("banner",$banner);
            return view();
        }
    }

    /**
     * @access public
     * @param 
     * @return json
     * @context 执行删除banner_item某条详情信息
     */
    public function bannerDetDel(){
        $id = $this->request->param("id");
        if(!$id){
            return json(['code'=>404,'msg'=>'未获取信息']);
        }else{
            $res = Db::name('banner_item')->where('id',$id)->update(['delete_time'=>time()]);
            if($res){
                return json(['code'=>200,'msg'=>'删除成功']);
            }else{
                return json(['code'=>404,'msg'=>'删除失败']);
            }
        }
    }
    
}