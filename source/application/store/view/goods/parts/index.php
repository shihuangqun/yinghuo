<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">商品分类</div>
                </div>
                <div class="widget-body am-fr">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="am-form-group">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a class="am-btn am-btn-default am-btn-success am-radius"
                                       href="<?= url('goods.parts/add') ?>">
                                        <span class="am-icon-plus"></span> 新增
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                            <thead>
                            <tr>
                                <th>分类ID</th>
                                <th>分类名称</th>
                                <th>分类排序</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $first): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $first['category_id'] ?></td>
                                    <td class="am-text-middle"><?= $first['name'] ?>（<?= $first['product_name']['name']?>）</td>
                                    <td class="am-text-middle"><?= $first['sort'] ?></td>
                                    <td class="am-text-middle"><?= date('Y-m-d H:i:s',$first['create_time']) ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <a href="<?= url('goods.parts/edit',
                                                ['category_id' => $first['category_id']]) ?>">
                                                <i class="am-icon-pencil"></i> 编辑
                                            </a>
                                            <a href="<?=url('goods.parts/del',['category_id' => $first['category_id']])?>" class="item-delete tpl-table-black-operation-del"
                                               data-id="">
                                                <i class="am-icon-trash"></i> 删除
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php if (!empty($first['sub'])): foreach ($first['sub'] as $two): ?>
                                    <tr>
                                        <td class="am-text-middle"><?= $two['category_id'] ?></td>
                                        <td class="am-text-middle">　-- <?= $two['name'] ?></td>
                                        <td class="am-text-middle"><?= $two['sort'] ?></td>
                                        <td class="am-text-middle"><?= date('Y-m-d H:i:s',$two['create_time']) ?></td>
                                        <td class="am-text-middle">
                                            <div class="tpl-table-black-operation">
                                                <a href="<?= url('goods.category/edit',
                                                    ['category_id' => $two['category_id']]) ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="<?=url('goods.parts/del',['category_id'=>$two['category_id']])?>" class="item-delete tpl-table-black-operation-del"
                                                   data-id="">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; endif; ?>
                                <?php if (!empty($two['sub'])): foreach ($two['sub'] as $three): ?>
                                    <tr>
                                        <td class="am-text-middle"><?= $three['category_id'] ?></td>
                                        <td class="am-text-middle">　---- <?= $three['name'] ?></td>
                                        <td class="am-text-middle"><?= $three['sort'] ?></td>
                                        <td class="am-text-middle"><?= date('Y-m-d H:i:s',$two['create_time']) ?></td>
                                        <td class="am-text-middle">
                                            <div class="tpl-table-black-operation">
                                                <a href="<?= url('goods.category/edit',
                                                    ['category_id' => $three['category_id']]) ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                                <a href="<?=url('goods.parts/del',['category_id'=>$three['category_id']])?>" class="item-delete tpl-table-black-operation-del"
                                                   data-id="">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; endif; ?>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="5" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        // 删除元素
        var url = "<?= url('goods.parts/delete') ?>";
        $('.item-delete').delete('category_id', url);

    });
</script>

