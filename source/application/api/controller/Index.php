<?php

namespace app\api\controller;

use app\api\model\WxappPage;
use app\api\model\Goods as GoodsModel;
use think\Db;
/**
 * 首页控制器
 * Class Index
 * @package app\api\controller
 */
class Index extends Controller
{
    /**
     * 首页diy数据
     * @return array
     * @throws \think\exception\DbException
     */
    public function page()
    {
        // 页面元素
        $wxappPage = WxappPage::detail();
        $items = $wxappPage['page_data']['array']['items'];
        // 新品推荐
        $model = new GoodsModel;
        $newest = $model->getNewList();
        // 猜您喜欢
        $best = $model->getBestList();
        return $this->renderSuccess(compact('items', 'newest', 'best'));
    }

    public function getTel(){

        $str = Db::name('setting')->where('key','store')->find();
        $arr = json_decode($str['values']);

        return $this->return_msg(200,'成功',$arr->tel);
    }
}
