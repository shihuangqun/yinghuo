<?php

namespace app\store\controller;

use app\store\model\User as UserModel;
use think\Db;
use think\Request;

/**
 * 用户管理
 * Class User
 * @package app\store\controller
 */
class User extends Controller
{
    /**
     * 用户列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->auth();
    }
    public function index()
    {
//        $model = new UserModel;
//        $list = $model->getList();
        $list = Db::name('user')->paginate(15,false,['query' => Request::instance()->request()]);
        $name = [];
        foreach($list as $k=>$v){
            $info = Db::name('store_user')->where('store_user_id',$v['parent_id'])->field('user_name')->find();
            $v['parent_name'] = $info['user_name'];
            $name [] = $v['parent_name'];
        }

        return $this->fetch('index', compact('list','name'));
    }

}
