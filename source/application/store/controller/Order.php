<?php

namespace app\store\controller;

use app\store\model\Order as OrderModel;
use think\Db;
use think\Request;
use think\Loader;
/**
 * 订单管理
 * Class Order
 * @package app\store\controller
 */
class Order extends Controller
{
    /**
     * 待发货订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function delivery_list()
    {
        return $this->getList('待发货订单列表', [
            'pay_status' => 20,
            'delivery_status' => 10
        ]);
    }

    /**
     * 待收货订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function receipt_list()
    {
        return $this->getList('待收货订单列表', [
            'pay_status' => 20,
            'delivery_status' => 20,
            'receipt_status' => 10
        ]);
    }

    /**
     * 待付款订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function pay_list()
    {
        return $this->getList('待付款订单列表', ['pay_status' => 10, 'order_status' => 10]);
    }

    /**
     * 已完成订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function complete_list()
    {
        return $this->getList('已完成订单列表', ['order_status' => 30]);
    }

    /**
     * 已取消订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function cancel_list()
    {
        return $this->getList('已取消订单列表', ['order_status' => 20]);
    }

    /**
     * 全部订单列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function all_list()
    {
        return $this->getList('全部订单列表');
    }

    /**
     * 订单列表
     * @param $title
     * @param $filter
     * @return mixed
     * @throws \think\exception\DbException
     */
    private function getList($title, $filter = [])
    {
        $model = new OrderModel;
        $list = $model->getList($filter);
        return $this->fetch('index', compact('title','list'));
    }

    /**
     * 订单详情
     * @param $order_id
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function detail($order_id)
    {
        $detail = OrderModel::detail($order_id);
        return $this->fetch('detail', compact('detail'));
    }

    /**
     * 确认发货
     * @param $order_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delivery($order_id)
    {
        $model = OrderModel::detail($order_id);
        if ($model->delivery($this->postData('order'))) {
            return $this->renderSuccess('发货成功');
        }
        $error = $model->getError() ?: '发货失败';
        return $this->renderError($error);
    }
    public function add(){

        $goods = Db::name('category')->where('parent_id',0)->select();

        $cates = [];
        $cate = [];
        foreach($goods as $k => $v){
            $v['sub'] = Db::name('goods')
                    ->where('category_id',$v['category_id'])
                    ->select();
            $cate[] = $v;
//            $v['sub'][] = Db::name('category')
//                    ->where('parent_id',$v['category_id'])
//                    ->select();
//
//
//            $cates[] = $v;

        }

//        foreach($cates as $ke => $va){
//
//            foreach($va['sub'] as $key => $val){
//
//                foreach($val as $kk=>$vv){
//
//                    $vv['sub'] = Db::name('goods')
//                        ->where('category_id',$vv['category_id'])
//                        ->select();
////                    dump($vv);
//                    $va['sub'] = $vv;
//                }
//
//
//            }
//            $cates['sub'] = $va['sub'];
//        }
//        dump($cates);
        $guarantee = Db::name('guarantee')->select();

        $this->assign([
            'cate' => $cate,
            'guarantee' => $guarantee
        ]);
        return $this->fetch();
    }
    public function doadd(){

        if(request()->isPost()){

            $res['pay_price'] = input('pay_price');
            $res['order_no'] = date('Ymd').rand(10000000,99999999);
            $res['total_price'] = $res['pay_price'];
            $res['wxapp_id'] = 10001;
            $res['user_id'] = 1;
            $res['guarantee_id'] = input('guarantee_id');
            $res['goods_no'] = input('goods_no');
            $res['create_time'] = time();
//            dump($res);exit;
            $order_id = Db::name('order')->insertGetId($res);

            if($order_id){
                $res_goods['goods_id'] = input('goods_id');
                $image = Db::name('goods_image')->find($res_goods['goods_id']);
                $res_goods['goods_price'] =$res['pay_price'];
                $res_goods['line_price'] =$res['pay_price'];
                $res_goods['total_price'] = $res['pay_price'];
                $res_goods['total_num'] = input('num');
                $res_goods['user_id'] = $res['user_id'];
                $res_goods['wxapp_id'] = $res['wxapp_id'];
                $res_goods['content'] = input('content');
                $res_goods['goods_name'] = '6666';
                $res_goods['image_id'] = $image['image_id'];
                $res_goods['order_id'] = $order_id;
                $res_goods['create_time'] = time();

                $address['name'] = input('name');
                $address['phone'] = input('phone');
                $address['province_id'] = '1964';
                $address['city_id'] = '1988';
                $address['region_id'] = '1993';
                $address['detail'] = '1111';
                $address['order_id'] = $order_id;
                $address['user_id'] = $res['user_id'];
                $address['wxapp_id'] = $res['wxapp_id'];
                $address['create_time'] = time();

                Db::startTrans();
                try{
                    $order_goods = Db::name('order_goods')->insert($res_goods);
                    $address = Db::name('order_address')->insert($address);

                    Db::commit();
                }catch(\Exception $e){
                    Db::rollback();
                }

                if($order_goods && $address){

                    return $this->return_msg(200,'添加订单成功');
                }else{

                    return $this->return_msg(400,'error');
                }

            }

        }

    }

    public function code_save(){

        if(request()->isPost()){

            $res['order_id'] = input('id');
            $res['goods_no'] = input('val');

            $data = Db::name('order')->update($res);

            if($data !== false){

                return $this->return_msg(200,'更新成功');
            }else{

                return $this->return_msg(400,'error');
            }
        }
    }

    public function daoru(){
        if($this->request->isPost()){
            $file = $this->request->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . '../web' .DS.'uploads'. DS . 'excel');

            if($info){
                //获取文件所在目录名
                $path=ROOT_PATH . '../web' . DS.'uploads'.DS .'excel/'.$info->getSaveName();
                //加载PHPExcel类
                vendor('PHPExcel.PHPExcel');
                //实例化PHPExcel类（注意：实例化的时候前面需要加'\'）
                $extension = $info->getExtension();
                if( $extension =='xlsx' )
                {
                    $objReader = new \PHPExcel_Reader_Excel2007();
                }else
                {
                    $objReader = new \PHPExcel_Reader_Excel5();
                }
                $objPHPExcel = $objReader->load($path,$encode='utf-8');//获取excel文件
                $sheet = $objPHPExcel->getSheet(0); //激活当前的表
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                $a=0;
                //将表格里面的数据循环到数组中
                for($i=2;$i<=$highestRow;$i++)
                {
                    //*为什么$i=2? (因为Excel表格第一行应该是姓名，年龄，班级，从第二行开始，才是我们要的数据。)
                    $data[$a]['pay_price'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                    $data[$a]['guarantee_id'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                    $data[$a]['goods_no'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                    $data[$a]['total_price'] = $data[$a]['pay_price'];
                    $data[$a]['order_no'] = date('Ymd').rand(10000000,99999999);
                    $data[$a]['wxapp_id'] = 10001;
                    $data[$a]['user_id'] = 1;
                    $data[$a]['create_time'] = time();

                    // 这里的数据根据自己表格里面有多少个字段自行决定
                    $a++;
                }
                //往数据库添加数据
                //dump($data);
                $aa = Db('order')->insertAll($data);
                if($aa){
                    $testres = Db::name('order')->getLastInsID();
                    $arr = [];
                    for ($i=0; $i<3; $i++) {
                        $arr[] = (int)$testres++;
                    }

                    $b=0;
                    for($i=2;$i<=$highestRow;$i++){

                        $res_goods[$b]['goods_id'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                        $image = Db::name('goods_image')->where('goods_id',$res_goods[$b]['goods_id'])->find();
                        $res_goods[$b]['goods_price'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                        $res_goods[$b]['line_price'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                        $res_goods[$b]['total_price'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                        $res_goods[$b]['total_num'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                        $res_goods[$b]['content'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                        $res_goods[$b]['goods_name'] = 666;
                        $res_goods[$b]['user_id'] = 1;
                        $res_goods[$b]['wxapp_id'] = 10001;
                        $res_goods[$b]['image_id'] = $image['image_id'];
                        $res_goods[$b]['order_id'] = $arr[$b];
                        $res_goods[$b]['create_time'] = time();

                        $address[$b]['name'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                        $address[$b]['phone'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
                        $address[$b]['province_id'] = '1964';
                        $address[$b]['city_id'] = '1988';
                        $address[$b]['region_id'] = '1993';
                        $address[$b]['detail'] = '1111';
                        $address[$b]['order_id'] = $arr[$b];
                        $address[$b]['user_id'] = 1;
                        $address[$b]['wxapp_id'] = 10001;
                        $address[$b]['create_time'] = time();

                        $b++;
                    }
                }
                Db::startTrans();
                try{
                    $res_goods = Db::name('order_goods')->insertAll($res_goods);
                    if($res_goods){
                        $address = Db::name('order_address')->insertAll($address);
                    }
                    Db::commit();
                }catch(\Exception $e){
                    Db::rollback();
                }

                if($address){

                    $res['code']=1;
                    $res['msg'] = '导入成功';
                }else{
                    $res['code']=0;
                    $res['msg'] = '导入失败！';
                }
                return $res;
            }

        }
        return $this->fetch();
    }
}
