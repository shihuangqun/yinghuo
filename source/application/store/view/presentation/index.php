<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">用户列表</div>
                </div>
<!--                <div class="am-btn-group am-btn-group-xs" style="float: right;margin-right:3%;">-->
<!--                    <a class="am-btn am-btn-default am-btn-success am-radius"-->
<!--                       href="--><?//= url('admin/add') ?><!--">-->
<!--                        <span class="am-icon-plus"></span> 新增-->
<!--                    </a>-->
<!--                </div>-->
                <div class="widget-body am-fr">
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>经销商ID</th>
                                <th>用户名</th>
                                <th>提现金额</th>

                                <th>申请时间</th>
                                <th>状态</th>
<!--                                <th>操作</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['user_name'] ?: '--' ?></td>
                                    <td class="am-text-middle"><?= $item['price'] ?: '--' ?></td>
                                    <td class="am-text-middle"><?= date('Y-m-d H:i:s',$item['addtime']) ?></td>
                                    <td>
                                        <?php if ($item['status'] == 0): ?>
                                            <button type="button" class="layui-btn layui-btn-radius" onclick="save_status(<?= $item['id'] ?>)" id="st">待审核</button>
                                        <?php else: ?>
                                            <button type="button" class="layui-btn layui-btn-radius" onclick="save_status(<?= $item['id'] ?>)" id="st">已通过</button>
                                        <?php endif;?>
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
    $(function () {

    });

    function save_status(id){
        var obj = $(this);

        $.ajax({
            type:'post',
            data:{id:id},
            dataType:'json',
            url:'<?= url('/store/presentation/save_status')?>',
            success: function(data){
                // if(data.code == 200){
                //     $(this).find('#st').html('正常')
                //     layer.msg(data.msg,{icon:1})
                // }else if(data.code == 300){
                //     $(this).find('#st').html('禁用')
                //     layer.msg(data.msg,{icon:1})
                // }
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1})
                    setTimeout(function(){
                        location.reload();
                    },1500)
                }
            }
        })
    }
</script>

