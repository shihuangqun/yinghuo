<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/26
 * Time: 15:33
 */
namespace app\store\controller;

use think\Db;
use think\Loader;
use think\Request;

Class Video extends Controller{

    public function index(){

        $list = Db::name('video')
                ->alias('v')
                ->join('goods as g','goods_id = v.product_id')
                ->paginate('10',false,['query' => Request::instance()->request()]);
//        dump($list);
        return $this->fetch('index',compact('list'));
    }

    public function add(){

        $goods = Db::name('category')->select();

        $cate = [];
        foreach($goods as $k => $v){
            $v['sub'] = Db::name('goods')
                ->where('category_id',$v['category_id'])
                ->select();
            $cate[] = $v;
        }

        return $this->fetch('add',compact('cate'));
    }

    public function doadd(){

        if(Request()->isPost()){
            $res = Request::instance()->except('video');

            $res['addtime'] = time();

            $res['video'] = $this->upload();

            $validate = Loader::Validate('video');

            if(!$validate->check($res)){
                return $this->return_msg('400',$validate->getError());
            }

            $data = Db::name('video')->insertGetId($res);

            if($data){
                Db::startTrans();
                try{
                    $result['goods_id'] = $res['product_id'];
                    $result['video_id'] = $data;
                    $save = Db::name('goods')->update($result);
                    Db::commit();
                }catch(\Exception $e){
                    Db::rollback();
                }

                return $this->return_msg(200,'成功');
            }
        }
    }

    public function edit(){

        $id = input('id');
        $goods = Db::name('category')->select();

        $cate = [];
        foreach($goods as $k => $v){
            $v['sub'] = Db::name('goods')
                ->where('category_id',$v['category_id'])
                ->select();
            $cate[] = $v;
        }
        $save = Db::name('video')->find($id);
        return $this->fetch('edit',compact('save','cate'));
    }

    public function doedit(){

        if(request()->isPost()){
            $res = Request::instance()->except('video');

            $infos = Db::name('video')->find($res['id']);

            $file = $this->upload();

            if($file){

                if($infos['video']){

                    $url = str_replace('/uploads','uploads',$infos['video']);

                    if(file_exists($url)){
                        unlink($url);
                    }
                }

                    $res['video'] = $file;
            }

                $gid = Db::name('video')->field('product_id')->find($res['id']);

                if($res['product_id'] != $gid['product_id']){

                    Db::startTrans();
                    try{
                        $save = Db::name('goods')->where('goods_id',$gid['product_id'])->update(['video_id' => '']);
                        if($save){
                            $result['goods_id'] = $res['product_id'];
                            $result['video_id'] = $res['id'];
                            Db::name('goods')->update($result);
                        }
                        Db::commit();
                    }catch(\Exception $e){
                        Db::rollback();
                    }
                }

            $data = Db::name('video')->update($res);


            if($data){
                return $this->return_msg(200,'修改成功');
            }else{
                return $this->return_msg(400,'失败');
            }

        }
    }
    //删除需要写删除产品关联ID
    public function del(){
        $id = input('id');

        $info = Db::name('video')->find($id);

        if($info['video']){
            $url = str_replace('/uploads','uploads',$info['video']);
            if(file_exists($url)){
                unlink($url);
            }
        }
        $del = Db::name('video')->delete($id);

        if($del){
            return $this->index();
        }
    }

    public function upload(){

        $file = request()->file('video');

        if($file){
            $info = $file->move(ROOT_PATH.'../web'.DS.'uploads');

            if($info){
                return DS.'uploads'.DS.$info->getSaveName();
            }else{
                return $this->return_msg(400,$file->getError());
            }
        }
    }
}