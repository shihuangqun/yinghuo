<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/28
 * Time: 14:42
 */
namespace app\store\controller;

use think\Db;
use think\Loader;
use think\Request;

Class Admin extends Controller{

    public function index(){

        $list = Db::name('store_user')->paginate(10,false,['query' => Request::instance()->request()]);
        return $this->fetch('index',compact('list'));
    }

    public function add(){
        if(request()->isPost()){

            $res = Request::instance()->param();
            $res['wxapp_id'] = 10001;
            $validate = Loader::Validate('admin');

            if(!$validate->check($res)){
                return $this->return_msg(400,$validate->getError());
            }

            unset($res['repassword']);

            $res['password'] = yoshop_hash($res['password']);
            $res['create_time'] = time();

            $data = Db::name('store_user')->insert($res);

            if($data){
                return $this->return_msg(200,'管理员添加成功');
            }else{
                return $this->return_msg(400,'error');
            }
        }

        return $this->fetch();
    }

    public function edit(){
        $id = input('store_user_id');
        $edit = Db::name('store_user')->find($id);
        if(request()->isPost()){

            $res = Request::instance()->param();

            $validate = Loader::Validate('admin');
            if(!$validate->check($res)){
                return $this->return_msg(400,$validate->getError());
            }

            unset($res['repassword']);
            $res['password'] = yoshop_hash($res['password']);

            $data = Db::name('store_user')->update($res);

            if($data !== false){
                return $this->return_msg(200,'更新成功');
            }else{
                return $this->return_msg(400,'更新失败');
            }

        }
        return $this->fetch('edit',compact('edit'));
    }

    public function del(){
        $id = input('store_user_id');

        $data = Db::name('store_user')->delete($id);

        if($data){
            return $this->index();
        }
    }
}