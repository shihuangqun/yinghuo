<?php

namespace app\api\controller;

use app\api\model\User as UserModel;
use think\Validate;
use think\Db;
/**
 * 用户管理
 * Class User
 * @package app\api
 */
class User extends Controller
{
    /**
     * 用户自动登录
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $model = new UserModel;
        $user_id = $model->login($this->request->post());
        $token = $model->getToken();
        return $this->renderSuccess(compact('user_id', 'token'));
    }
    public function regCode(){

        if(request()->isPost()){

            $res['buy_time'] = input('buy_time');
            $res['goods_no'] = input('goods_no');

            $rule = [
                'buy_time|购买日期' => 'require',
                'goods_no|产品注册码' => 'require'
            ];

            $validate = new Validate();

            if(!$validate->check($res)){
                return $this->return_msg(400,$validate->getError());
            }

            $info = Db::name('order')->where('goods_no',$res['goods_no'])->find();

            if(!$info){
                return $this->return_msg(400,'该产品注册码不存在，请核对后重新输入');
            }

            $data = Db::name('order')->where('goods_no',$res['goods_no'])->update(['buy_time' => $res['buy_time']]);

            if($data){
                return $this->return_msg(200,'注册成功');
            }else{
                return $this->return_msg(400,'error');
            }
        }
    }

}
