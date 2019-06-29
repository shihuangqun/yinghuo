<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/28
 * Time: 14:49
 */
namespace app\store\validate;

use think\Validate;

Class Admin extends Validate{

    protected $rule = [
        'user_name|用户名' => 'require|min:5|max:16|unique:store_user',
        'password|密码' => 'require|min:6|max:16',
        'repassword|确认密码' => 'require|confirm:password'
    ];
    protected $message = [

        'repassword.confirm' => '俩次密码不一致'
    ];
}