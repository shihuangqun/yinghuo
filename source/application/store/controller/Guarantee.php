<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/24
 * Time: 17:14
 */
namespace app\store\controller;

use think\Db;
use think\Request;
Class Guarantee extends Controller{

    public function index(){

        $list = Db::name('guarantee')->paginate(10,false,['query'=>Request::instance()->request()]);

//        dump($list);
        return $this->fetch('index',compact('list'));
    }

    public function add(){

        return $this->fetch();
    }

    public function doadd(){
        if(Request()->isPost()){

            $res = Request::instance()->param();
            $res['addtime'] = time();

            $data = Db::name('guarantee')->insert($res);
            if($data){
                echo 1;
            }
        }
    }

    public function edit(){
        $id = input('id');

        $edit = Db::name('guarantee')->find($id);
        return $this->fetch('edit',compact('edit'));
    }
    public function doedit(){

        if(request()->isPost()){
            $res = Request::instance()->param();

            Db::startTrans();

            try{
                $data = Db::name('guarantee')->update($res);
                Db::commit();
            } catch(\Exception $e){
                Db::rollback();
            }

            if($data){
                echo 1;
            }

        }
    }

    public function del(){

        $id = input('id');

        $data = Db::name('guarantee')->delete($id);

        if($data){
            return $this->index();
        }
    }
}

