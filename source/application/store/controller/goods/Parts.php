<?php

namespace app\store\controller\goods;

use app\store\controller\Controller;
use think\Db;
use think\Request;

/**
 * 商品分类
 * Class Category
 * @package app\store\controller\goods
 */
class Parts extends Controller
{
    /**
     * 商品分类列表
     * @return mixed
     */
    public function index()
    {

        $list = self::getCate(0);


        return $this->fetch('index', compact('list'));
    }

    public static function getCate($pid){
        $cates = Db::name('category_parts')->where('parent_id',$pid)->select();

        $cate = [];
        foreach($cates as $k => $v){
            $v['sub'] = self::getCate($v['category_id']);
            $v['product_name'] = Db::name('category')->where('category_id',$v['product_cateid'])->field('name')->find();
            $cate[] = $v;
        }

        return $cate;
    }

    /**
     * 删除商品分类
     * @param $category_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delete($category_id)
    {
        $model = PartsModel::get($category_id);
        if (!$model->remove($category_id)) {
            $error = $model->getError() ?: '删除失败';
            return $this->renderError($error);
        }
        return $this->renderSuccess('删除成功');
    }

    /**
     * 添加商品分类
     * @return array|mixed
     */
    public function add()
    {
        $list = [];
        $num = 1;
        $lists = Db::name('category_parts')->select();
        foreach($lists as $k => $v){
            if($v['parent_id'] != 0){
                $v['num'] = $num++;
                $v['name'] = str_repeat('-- ',$v['num']).$v['name'];
            }
            $list[] = $v;
        }

        $cate = Db::name('category')->where('parent_id',0)->select();
        if(request()->isPost()){
            $res = Request::instance()->param();
            $res['create_time'] = time();
            $data = Db::name('category_parts')->insert($res);

            if($data){
                return $this->return_msg(200,'添加成功');
            }else{
                return $this->return_msg(400,'error');
            }
        }
       return $this->fetch('add',compact('list','cate'));
    }

    /**
     * 编辑配送模板
     * @param $category_id
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        $id = input('category_id');
        $list = [];
        $num = 1;
        $lists = Db::name('category_parts')->select();
        foreach($lists as $k => $v){
            if($v['parent_id'] != 0){
                $v['num'] = $num++;
                $v['name'] = str_repeat('-- ',$v['num']).$v['name'];
            }
            $list[] = $v;
        }
        $cate = Db::name('category')->where('parent_id',0)->select();
        $model = Db::name('category_parts')->find($id);

        if(request()->isPost()){
            $res = Request::instance()->param();
            $res['update_time'] = time();
            $data = Db::name('category_parts')->update($res);

            if($data){
                return $this->return_msg(200,'修改成功');
            }else{
                return $this->return_msg(400,'error');
            }
        }
        return $this->fetch('edit',compact('model','list','cate'));
    }

    public function del(){
        $id = input('category_id');

        $data = Db::name('category_parts')->delete($id);

        if($data){
            return $this->index();
        }
    }

}
