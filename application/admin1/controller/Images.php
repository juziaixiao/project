<?php
/**
 * @projectname
 * @version 1.0
 * @author 丁文爽
 * @date 2018/10/17
 * @email:d_w@chunyimail.com
 * @context 后台图片控制器
 */
namespace app\admin\controller;
use app\lib\exception\Bannerexception;
use app\lib\exception\Errorexception;
use app\lib\exception\Imageexception;
use app\lib\exception\MissException;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessMessage;
use think\Model;
use think\Db;
use think\Request;
use think\Session;
use app\admin\validate\BanneritemNew;
use app\admin\validate\Bannernew;
use app\api\validate\IDMustBePositiveInt;
class Images extends Basecontroller
{
    /**
     * @access public
     * @param
     * @return
     * @context 图片展示
     */
    public function imageList(){
        $re=array(
            ['id'=>1,'url'=>'/uploads/20181022/40a9277d0ebce22488b4a89e335f765f.PNG']
        );
        return view('imagelist',
            ['photo'=>$re,]
        );
  }


    /**
     * webuploader 上传demo
     */
    public function webuploader()
    {
        $re=array();
        $re[]=array('id');
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

        return json(['id'=>$info->getSaveName()]);
    }

    public function delfile(){

        $url = input('post.url');
        $ids = input('post.id');
       // return json(array('code'=>200,'msg'=>input('post.url')));die;
        $result = unlink($url);
        if ($result == true) {
            //db('photo')->where('id',$ids)->delete();
            return json(array('code'=>200,'msg'=>'删除成功'));die;
        }else
            return json(array('code'=>0,'msg'=>'删除失败，请刷新页面'));

    }

    public function editimage(){
        return view();
    }
}