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
                                           value="" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">角色 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="rid" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择延保服务'}">

                                        <?php if (isset($role)): foreach($role as $item): ?>
                                            <option value="<?= $item['id']?>?>"><?= $item['name']?></option>

                                        <?php endforeach; endif;?>

                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= url('role/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
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
            url:'<?=url('admin/add')?>',
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
