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
                                <label class="am-u-sm-3 am-form-label form-require"> 角色名 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="name"
                                           value="" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 权限设置 </label>
                                <div class="am-u-sm-9 rids">
                                    <?php foreach($rule as $ro):?>
                                <label><input type="checkbox" value="<?= $ro['id']?>" id="rids"><?= $ro['name']?></label>
                                        <br>
                                <?php endforeach;?>
                                    <input type="hidden" name="rid" id="arr">
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
    $('.rids').on('click','#rids',function(){
        var oldval = $('#arr').val();
        var rid = $(this).val();
        var arr = oldval+','+rid;
        $('#arr').attr('value',arr);
    });
    function btn(){
        $.ajax({
            type:'post',
            data:$('#my-form').serialize(),
            dataType:'json',
            url:'<?=url('role/add')?>',
            success: function(data){
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1})

                    setTimeout(function(){
                        location.href = '<?=url('role/index')?>';
                    },1500)
                }else{
                    layer.msg(data.msg,{icon:5})
                }
            }
        })
    }

</script>
