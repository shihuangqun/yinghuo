<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/9
 * Time: 16:35
 */
namespace app\api\controller;

use think\Db;
use think\Exception;
use think\Request;
use think\Validate;

Class Matter extends Controller{

    public static function getCate($pid){

        $cates = Db::name('category_parts')->where('parent_id',$pid)->select();

        $cate = [];
        foreach($cates as $key => $val){
            $val['sub'] = self::getCate($val['category_id']);

            $cate[] = $val;
        }

        return $cate;
    }

    public function getMatterCate(){

        $cate = self::getCate(0);


        return $this->return_msg(200,'成功',$cate);
    }


    public function add(){

        if(request()->isPost()){
            $res = Request::instance()->except('wxapp_id');

            $res['addtime'] = time();
            $rule = [
                'cate_id|问题分类' => 'require',
                'title|问题' => 'require'
            ];

            $validate = new Validate($rule);

            if(!$validate->check($res)){
                return $this->return_msg(400,$validate->getError());
            }

            $data = Db::name('matter')->insert($res);

            if($data){
                return $this->return_msg(200,'成功');
            }else{
                return $this->return_msg(400,'error');
            }
        }
    }

    public function reply(){

        if(request()->isPost()){
            $res = Request::instance()->except('wxapp_id');
            $res['addtime'] = time();
            $rule = [
                'content|回复内容' => 'require',
                'matter_id|问题ID' => 'require'
            ];

            $validate = new Validate($rule);

            if(!$validate->check($res)){
                return $this->return_msg(400,$validate->getError());
            }

            try{
                $data = Db::name('matter_reply')->insert($res);

                if($data){
                    return $this->return_msg(200,'成功');
                }

            }catch(Exception $e){
                return $this->return_msg(400,'error');
            }
        }
    }

}