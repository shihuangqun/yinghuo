<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">财务管理</div>
                </div>
                <div class="widget-body am-fr">
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <div class="am-u-lg-12 am-cf">
                            <span>我的余额：<?= $balance['money']?></span>
                            <br><br>



                                <div class="layui-input-inline" style="width:10%">
                                    <input type="tel" id="money" lay-verify="required autocomplete="off" class="layui-input" style="height:29px">
                                </div>

                                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" onclick="presentation()">提现</button>


                            <div class="am-fr pagination-total am-margin-right">
                                <div class="am-vertical-align-middle">总收入：<?= $totalprice?></div>
                            </div>
                        </div>
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>商品名</th>
                                <th>商品图</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>商品编码</th>
                                <th>用户名</th>
                                <th>头像</th>
                                <th>比例</th>
                                <th>付款金额</th>
                                <th>下单时间</th>
                                <th>分红</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $k =>$item): ?>

                                <tr>
                                    <td class="am-text-middle"><?= $item['order_no']?></td>
                                    <td class="am-text-middle"><?= $item['goods_name']?></td>
                                    <td class="am-text-middle">
                                        <a href="uploads/<?= $item['file_name']?>" title="点击查看大图" target="_blank">
                                            <img src="uploads/<?= $item['file_name']?>" width="72" height="72" alt="">
                                        </a>
                                    </td>
                                    <td class="am-text-middle"><?= $item['goods_price']?></td>
                                    <td class="am-text-middle"><?= $item['total_num']?></td>
                                    <td class="am-text-middle"><?= $item['goods_no']?></td>
                                    <td class="am-text-middle"><?= $item['nickName']?></td>
                                    <td class="am-text-middle">
                                        <a href="<?= $item['avatarUrl']?>" title="点击查看大图" target="_blank">
                                            <img src="<?= $item['avatarUrl']?>" width="72" height="72" alt="">
                                        </a>
                                    </td>
                                    <td class="am-text-middle"><?= $item['bonus_ratio']?>%</td>
                                    <td class="am-text-middle"><?= $item['pay_price']?></td>
                                    <td class="am-text-middle"><?= date('Y-m-d H:i:s',$item['create_time'])?></td>
                                    <td class="am-text-middle"><?= $bonus_price[$k]?></td>
                                </tr>

                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="8" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"><?= $list->render()?></div>
                        <div class="am-fr pagination-total am-margin-right">
                            <div class="am-vertical-align-middle">总记录：<?= count($list)?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {

    });

    function presentation(){
        var money = $('#money').val();

        if($.trim(money) == ''){
            $('#money').focus();
            layer.msg('请输入提现金额',{icon:6})
            return false;
        }
        $.ajax({
            type:'post',
            data:{money:money},
            dataType:'json',
            url:'<?= url('store/finance/presentation_money')?>',
            success: function(data){
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1})
                    setTimeout(function(){
                        location.reload()
                    },1500)
                }else{
                    layer.msg(data.msg,{icon:0})
                }
            }
        })

    }
</script>

