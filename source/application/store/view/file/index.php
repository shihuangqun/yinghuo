<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">延保服务</div>
                </div>
                <div class="widget-body am-fr">

                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <div class="am-btn-group am-btn-group-xs" style="float: right;">
                            <a class="am-btn am-btn-default am-btn-success am-radius"
                               href="<?= url('file/add') ?>">
                                <span class="am-icon-plus"></span> 新增
                            </a>
                        </div>
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>所属分类|商品</th>
                                <th>标题</th>

                                <th>添加时间</th>
                                <th>操作</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!$list->isEmpty()): foreach($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle">（<?= $item['category_name']?>）<?= $item['goods_name']?></td>
                                    <td class="am-text-middle"><?= $item['title']?></td>
<!--                                    <td class="am-text-middle">--><?//= $item['file']?><!--</td>-->
                                    <td class="am-text-middle"><?= $item['addtime']?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="<?= url('file/edit',['id' => $item['id']])?>">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a href="<?=url('file/del',['id'=>$item['id']])?>" class="item-delete tpl-table-black-operation-del"
                                               data-id="">
                                                <i class="am-icon-trash"></i> 删除
                                            </a>
                                        </div>
                                    </td>
                                    <td class="am-text-middle">
                                        <div class="am-btn-group am-btn-group-xs" style="float: right;">
                                            <a class="am-btn am-btn-default am-btn-danger am-radius"
                                               href="<?= $item['file']?>">
                                                点此下载
                                            </a>
                                        </div>
                                    </td>
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
                        <div class="am-fr"><?= $list->render() ?></div>
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
    $(function () {

    });
</script>

