<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/26
 * Time: 17:16
 */
namespace app\store\Validate;

use think\Validate;

Class Video extends Validate{

    protected $rule = [
        'title' => 'require',
        'video' => 'require'
    ];

    protected $message = [

    ];
}