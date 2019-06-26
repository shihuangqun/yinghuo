<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/25
 * Time: 9:21
 */
namespace app\storm\model;

use app\common\model\BaseModel;
use think\Db;

Class Guarantee extends BaseModel{

    protected $table = 'guarantee';

    public function getList(){

        $model = new Guarantee();

        $list = $model->select();

        return $list;
    }
}