<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">财务管理</div>
                </div>
                <div class="widget-body am-fr">
                    <form action="<?=url('/store/finance/index')?>" method="post">
                        开始时间：<input type="date" name="start_time" id="start_time">
                        结束时间：<input type="date" name="end_time" id="end_time">
                        <input type="submit" value="查询">
                    </form>
                    <div class="am-scrollable-horizontal am-u-sm-12"><br>
<!--                        <div class="am-btn-group am-btn-group-xs" style="float: right;">-->
<!--                            <a class="am-btn am-btn-default am-btn-success am-radius"-->
<!--                               href="--><?//= url('guarantee/add') ?><!--">-->
<!--                                <span class="am-icon-plus"></span> 新增-->
<!--                            </a>-->
<!--                        </div>-->
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
<!--                                <th>商品名</th>-->
<!--                                <th>下单价格</th>-->
<!--                                <th>下单时间</th>-->
<!---->
<!--                                <th>操作</th>-->

                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <th >时间区间</th>
                                <th>未付款</th>
                                <th>已付款</th>

                            </tr>


                            <tr>
                                <th>本周</th>
                                <th><?=$week_nototal?></th>
                                <th><?=$week_total?></th>
                            </tr>
                            <tr>
                                <th>本月</th>
                                <th><?=$month_nototal?></th>
                                <th><?=$month_total?></th>
                            </tr>
                            <tr>
                                <th>今年</th>
                                <th><?=$year_nototal?></th>
                                <th><?=$year_total?></th>
                            </tr>
                            <tr>
                                <th >
                                    <?php if(!$start_time && !$end_time):?>
                                        合计
                                    <?php else: ?>
                                        <?php if($start_time && !$end_time):?>
                                            <?= $start_time;?> -- 结束
                                        <?php endif;?>
                                        <?php if(!$start_time && $end_time):?>
                                            开始 -- <?= $end_time;?>
                                        <?php endif;?>
                                        <?php if($start_time && $end_time):?>
                                            <?= $start_time;?> -- <?= $end_time;?>
                                        <?php endif;?>

                                    <?php endif;?>
                                </th>
                                <th><?= $no_total?></th>
                                <th><?= $total?></th>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"></div>
                        <div class="am-fr pagination-total am-margin-right">
<!--                            <div class="am-vertical-align-middle">总记录：</div>-->
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
</script>

