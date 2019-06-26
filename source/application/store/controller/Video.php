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



            $file = request()->file('video');

            if($file){
                $info = $file->move(ROOT_PATH.'public'.DS.'upload');

                if($info){
                    $res['video'] = DS.'upload'.DS.$info->getSaveName();
                }else{
                    return $this->return_msg(400,$file->getError());
                }
            }

            $validate = Loader::Validate('video');

            if(!$validate->check($res)){
                return $this->return_msg('400',$validate->getError());
            }

            $data = Db::name('video')->insert($res);
//
            if($data){

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

            $file = request()->file('video');

            if($file){

                if($infos['video']){

                    $url = syr_replace('\upload','upload',$infos['video']);

                    if(file_exists($url)){
                        unlink($url);
                    }
                }
                $info = $file->move(ROOT_PATH.'public'.DS.'upload');

                if($info){
                    $res['video'] = DS.'upload'.DS.$info->getSaveName();
                }else{
                    return $this->return_msg(400,$file->getError());
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
}