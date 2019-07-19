<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">管理员设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 用户名 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="user_name"
                                           value="<?=$edit['user_name']?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">角色 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="rid" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择延保服务'}">

                                        <?php if (isset($role)): foreach($role as $item): ?>
                                            <option value="<?= $item['name']?>?>" <?php if($item['id'] == $edit['rid']):?>selected<?php endif?>><?php if($item['name'] == 0):?>
                                                    超级管理员
                                                <?php else:?>
                                                    经销商用户<?php endif?></option>

                                        <?php endforeach; endif;?>

                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= url('role/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="am-u-sm-3 am-form-label form-require"> 地区 </label>
                                <div class="layui-input-inline adds">
                                    <select  id="sheng">
                                        <option value="">请选择省</option>
                                    </select>
                                </div>

                            </div>
                            <input type="hidden" name="adds" value="<?=$edit['adds']?>" id="adds">
                            <input type="hidden" name="store_user_id" value="<?=$edit['store_user_id']?>">
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 登录密码 </label>
                                <div class="am-u-sm-9">
                                    <input type="password" class="tpl-form-input" name="password"
                                           value="" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 确认密码 </label>
                                <div class="am-u-sm-9">
                                    <input type="password" class="tpl-form-input" name="repassword"
                                           value="" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="button" class="j-submit am-btn am-btn-secondary" onclick="btn()">提交
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/UI/layui/layui-v2.4.5/layui/layui.js"></script>
<script src="assets/store/js/jquery-1.8.3.min.js"></script>
<script>
    $(function () {

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
    function btn(){
        $.ajax({
            type:'post',
            data:$('#my-form').serialize(),
            dataType:'json',
            url:'<?=url('admin/edit')?>',
            success: function(data){
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1})

                    setTimeout(function(){
                        location.href = '<?=url('admin/index')?>';
                    },1500)
                }else{
                    layer.msg(data.msg,{icon:5})
                }
            }
        })
    }

</script>
<script>
    $(function () {
        layui.use(['form', 'layedit', 'laydate'], function(){
            var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,laydate = layui.laydate;

        });
    })

    $.ajax({
        type:"post",
        data:{pid:0},
        dataType:'json',
        url:"<?=url('store/distributor/getProvince')?>",
        success: function(data){
            var json = eval(data);

            $.each(json,function(index){
                var html = `<option value="${json[index].id}">${json[index].name}</option>`;
                $('#sheng').append(html);
            })
        }
    })

    $(document).on('change','select',function(){
        var obj = $(this);
        var pid = $(this).attr('value');

        obj.parent('.layui-input-inline').nextAll('.layui-input-inline').remove();
        $.ajax({
            type:'post',
            data:{pid:pid},
            dataType:'json',
            url:'<?=url('store/distributor/getProvince')?>',
            success: function(data){
                // var adds = $("select option:selected").text();
                var thisAds = obj.find('option:selected').text();
                $('#adds').attr('value',adds);
                ad = $('#adds').val();
                adds = ad+','+thisAds;
                str = adds.split('[object HTMLInputElement],');
                $('#adds').attr('value',str[1]);

                var json = eval(data);

                if(null !=json && "" !=json){
                    var div = $('<div class="layui-input-inline"></div>');
                    var select = $('<select></select>');

                    var option = $('<option value="">请选择省</option>');
                    select.append(option);

                    $.each(json,function(index){
                        var op = `<option value="${json[index].id}">${json[index].name}</option>`;
                        select.append(op);
                    })
                    div.append(select);
                    obj.parent('div').after(div);

                }
            }
        })
    });
</script>