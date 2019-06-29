<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf"><?= $title ?></div>

                </div>
                <form action="<?=url('order/daoru')?>" enctype="multipart/form-data" method="post">

                    <div class="layui-upload">
                        <button type="button" class="layui-btn layui-btn-normal" id="test8">选择文件</button>
                        <button type="button" class="layui-btn" id="test9">开始导入到数据库</button>
                    </div>
                </form>
                <div class="am-btn-group am-btn-group-xs" style="float: right;margin-right:3%;">
                    <a class="am-btn am-btn-default am-btn-success am-radius"
                       href="<?= url('order/add') ?>">
                        <span class="am-icon-plus"></span> 新增
                    </a>
                </div>

                <div class="widget-body am-fr">
                    <div class="order-list am-scrollable-horizontal am-u-sm-12 am-margin-top-xs">
                        <table width="100%" class="am-table am-table-centered
                        am-text-nowrap am-margin-bottom-xs">
                            <thead>
                            <tr>
                                <th width="30%" class="goods-detail">商品信息</th>
                                <th width="10%">单价/数量</th>
                                <th width="15%">实付款</th>
<!--                                <th>买家</th>-->
                                <th>商品编码</th>
                                <th>交易状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $order): ?>
                                <tr class="order-empty">
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                    <td class="am-text-middle am-text-left" colspan="6">
                                        <span class="am-margin-right-lg"> <?= $order['create_time'] ?></span>
                                        <span class="am-margin-right-lg">订单号：<?= $order['order_no'] ?></span>
                                    </td>
                                </tr>
                                <?php $i = 0;
                                foreach ($order['goods'] as $goods): $i++; ?>
                                    <tr>
                                        <td class="goods-detail am-text-middle">
                                            <div class="goods-image">
                                                <img src="<?= $goods['image']['file_path'] ?>" alt="">
                                            </div>
                                            <div class="goods-info">
                                                <p class="goods-title"><?= $goods['goods_name'] ?></p>
                                                <p class="goods-spec am-link-muted">
                                                    <?= $goods['goods_attr'] ?>
                                                </p>
                                            </div>
                                        </td>
                                        <td class="am-text-middle">
                                            <p>￥<?= $goods['goods_price'] ?></p>
                                            <p>×<?= $goods['total_num'] ?></p>
                                        </td>
                                        <?php if ($i === 1) : $goodsCount = count($order['goods']); ?>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <p>￥<?= $order['pay_price'] ?></p>
                                                <p class="am-link-muted">(含运费：￥<?= $order['express_price'] ?>)</p>
                                            </td>
<!--                                            <td class="am-text-middle" rowspan="--><?//= $goodsCount ?><!--">-->
<!--                                                <p>--><?//= $order['user']['nickName'] ?><!--</p>-->
<!--                                                <p class="am-link-muted">(用户id：--><?//= $order['user']['user_id'] ?><!--)</p>-->
<!--                                            </td>-->
                                            <td class="am-text-middle goods_no" rowspan="<?= $goodsCount ?>">
                                                <p><?= $order['goods_no'] ?></p>
                                                <input type="hidden" id="id" value="<?= $order['order_id']?>">
<!--                                                <p class="am-link-muted">(含运费：￥--><?//= $order['express_price'] ?><!--)</p>-->
                                            </td>

                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <p>付款状态：
                                                    <span class="am-badge
                                                <?= $order['pay_status']['value'] == 20 ? 'am-badge-success' : '' ?>">
                                                        <?= $order['pay_status']['text'] ?></span>
                                                </p>
                                                <p>发货状态：
                                                    <span class="am-badge
                                                <?= $order['delivery_status']['value'] == 20 ? 'am-badge-success' : '' ?>">
                                                        <?= $order['delivery_status']['text'] ?></span>
                                                </p>
                                                <p>收货状态：
                                                    <span class="am-badge
                                                <?= $order['receipt_status']['value'] == 20 ? 'am-badge-success' : '' ?>">
                                                        <?= $order['receipt_status']['text'] ?></span>
                                                </p>
                                            </td>
                                            <td class="am-text-middle" rowspan="<?= $goodsCount ?>">
                                                <div class="tpl-table-black-operation">
                                                    <a class="tpl-table-black-operation-green"
                                                       href="<?= url('order/detail', ['order_id' => $order['order_id']]) ?>">
                                                        订单详情</a>
                                                    <?php if ($order['pay_status']['value'] == 20
                                                        && $order['delivery_status']['value'] == 10): ?>
                                                        <a class="tpl-table-black-operation"
                                                           href="<?= url('order/detail#delivery',
                                                               ['order_id' => $order['order_id']]) ?>">
                                                            去发货</a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"><?= $list->render() ?> </div>
                        <div class="am-fr pagination-total am-margin-right">
                            <div class="am-vertical-align-middle">总记录：<?= $list->total() ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('.goods_no').bind("dblclick",function () {
        var id = $(this).find('#id').val();
        var oldval = $(this).find('p').html();

        var input = "<input type='text' id='save' value="+oldval+">";

        $(this).find('p').html(input);
        $('#save').val('').focus().val(oldval);

        $('#save').blur(function(){
            var obj = $(this);
            var val = $(this).val();

            $.ajax({
                type:'post',
                data:{id:id,val:val},
                dataType:'json',
                url:'<?=url('order/code_save')?>',
                success: function(data){
                    console.log(data);
                    if(data.code == 200){
                        obj.parent('p').html(val);
                        layer.msg(data.msg,{icon:1});

                    }else{
                        obj.parent('p').html(oldval);
                        layer.msg(data.msg,{icon:5});

                    }
                },
                error: function(){
                    console.log('服务器故障');
                }
            })


        });
    })

</script>

