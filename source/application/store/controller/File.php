<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/27
 * Time: 11:56
 */
namespace app\store\controller;

use think\Db;
use think\Request;

Class File extends Controller{

    public function index(){

        $list = Db::name('file')->paginate(10,false,['query'=>Request::instance()->request()]);
        return $this->fetch('index',compact('list'));
    }

    public function add(){

        return $this->fetch();
    }

    public function doadd(){
        if(request()->isPost()){

            $res = Request::instance()->except('file');
            $res['addtime'] = time();
            $res['file'] = $this->upload();

            $data = Db::name('file')->insert($res);

            if($data){
                return $this->return_msg(200,'成功');
            }else{
                return $this->return_msg(400,'error');
            }
        }
    }

    public function edit(){
        $id = input('id');
        $edit = Db::name('file')->find($id);
        return $this->fetch('edit',compact('edit'));
    }

    public function doedit(){

        if(request()->isPost()){
            $res = Request::instance()->except('file');

            $file = $this->upload();

            if($file){
                $info = Db::name('file')->find($res['id']);

                if($info['file']){
                    $url = str_replace('/uploads','uploads',$info['file']);

                    if(file_exists($url)){
                        unlink($url);
                    }
                }
                $res['file'] = $file;
            }

            $data = Db::name('file')->update($res);

            if($data){
                return $this->return_msg(200,'修改成功');
            }else{
                return $this->return_msg(400,'error');
            }
        }
    }
    public function del(){
        $id = input('id');

        $info = Db::name('file')->find($id);

        if($info['file']){
            $url = str_replace('/uploads','uploads',$info['file']);
            if(file_exists($url)){
                unlink($url);
            }
        }
        $data = Db::name('file')->delete($id);

        if($data){
            return $this->index();
        }
    }
    public function upload(){

        $file = request()->file('file');

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