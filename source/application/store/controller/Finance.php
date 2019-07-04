<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/3
 * Time: 14:26
 */
namespace app\store\controller;

use think\Db;
use think\Request;

Class Finance extends Controller{

    public function index(){
        $start_time = strtotime(input('start_time'));
        $end_time = strtotime(input('end_time'));

       if($start_time && $end_time){
           $list = Db::name('order')
               ->alias('o')
               ->where('o.create_time', '>', $start_time)
               ->where('o.create_time', '<', $end_time)
               ->order('o.create_time','desc')
               ->join('order_address oa','oa.order_id = o.order_id')
               ->join('order_goods og','og.order_id = o.order_id')
               ->join('goods_image gi','gi.goods_id = og.goods_id')
               ->join('upload_file uf','uf.file_id = gi.image_id')
               ->field('o.create_time as addtime,o.*,og.*')
               ->paginate(10,false,['query' => Request::instance()->request()]);
       }else if($start_time){
           $list = Db::name('order')
               ->alias('o')
               ->where('o.create_time', '>', $start_time)
               ->order('o.create_time','desc')
               ->join('order_address oa','oa.order_id = o.order_id')
               ->join('order_goods og','og.order_id = o.order_id')
               ->join('goods_image gi','gi.goods_id = og.goods_id')
               ->join('upload_file uf','uf.file_id = gi.image_id')
               ->field('o.create_time as addtime,o.*,og.*')
               ->paginate(10,false,['query' => Request::instance()->request()]);
       }else if($end_time){
           $list = Db::name('order')
               ->alias('o')
               ->where('o.create_time', '<', $end_time)
               ->order('o.create_time','desc')
               ->join('order_address oa','oa.order_id = o.order_id')
               ->join('order_goods og','og.order_id = o.order_id')
               ->join('goods_image gi','gi.goods_id = og.goods_id')
               ->join('upload_file uf','uf.file_id = gi.image_id')
               ->field('o.create_time as addtime,o.*,og.*')
               ->paginate(10,false,['query' => Request::instance()->request()]);
       }else{
           $list = Db::name('order')
               ->alias('o')
               ->order('o.create_time','desc')
               ->join('order_address oa','oa.order_id = o.order_id')
               ->join('order_goods og','og.order_id = o.order_id')
               ->join('goods_image gi','gi.goods_id = og.goods_id')
               ->join('upload_file uf','uf.file_id = gi.image_id')
               ->field('o.create_time as addtime,o.*,og.*')
               ->paginate(10,false,['query' => Request::instance()->request()]);
       }
        $total = 0;
        $no_total = 0;
        foreach($list as $k=>$v){
            if($v['pay_status'] == 20){
                $total += $v['pay_price'];
            }else if($v['pay_status'] == 10){
                $no_total += $v['pay_price'];
            }
        }
       $week = $list = Db::name('order')
           ->whereTime('create_time','week')
           ->select();
        $week_total = 0;
        $week_nototal = 0;
        foreach($week as $zhou){
            if($zhou['pay_status'] == 20){
                $week_total += $zhou['pay_price'];
            }else if($zhou['pay_status'] == 10){
                $week_nototal += $zhou['pay_price'];
            }
        }
       $month = $list = Db::name('order')
            ->whereTime('create_time','month')
           ->select();

        $month_total = 0;
        $month_nototal = 0;
        foreach($month as $yue){
            if($yue['pay_status'] == 20){
                $month_total += $yue['pay_price'];
            }else if($yue['pay_status'] == 10){
                $month_nototal += $yue['pay_price'];
            }
        }
        $year = $list = Db::name('order')
            ->whereTime('create_time','year')
            ->select();
        $year_total = 0;
        $year_nototal = 0;
        foreach($year as $n){
            if($n['pay_status'] == 20){
                $year_total += $n['pay_price'];
            }else if($n['pay_status'] == 10){
                $year_nototal += $n['pay_price'];
            }
        }

        $this->assign([
            'list' => $list,
            'total' => $total,
            'no_total' => $no_total,
            'week_total' => $week_total,
            'week_nototal' => $week_nototal,
            'month_total' => $month_total,
            'month_nototal' => $month_nototal,
            'year_total' => $year_total,
            'year_nototal' => $year_nototal,
            'start_time' => input('start_time'),
            'end_time' => input('end_time')

        ]);
        return $this->fetch();
    }


}