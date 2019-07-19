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
                                <label class="am-u-sm-3 am-form-label form-require"> 角色管理 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="name" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择延保服务'}">
                                        <option value="0" <?php if($edit['name'] == '0'):?>selected<?php endif?>>超级管理员</option>
                                        <option value="1" <?php if($edit['name'] == '1'):?>selected<?php endif?>>经销商用户</option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 权限设置 </label>
                                <div class="am-u-sm-9 rids">
                                    <?php foreach($rule as $ro):?>
                                        <label><input type="checkbox" value="<?= $ro['id']?>" name="check" id="rids" <?php if(in_array($ro['id'],$rid)):?>checked<?php endif?>><?= $ro['name']?></label>
                                        <br>


                                    <?php endforeach;?>
                                    <input type="hidden" name="rid" id="arr" value="<?= $edit['rid']?>">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$edit['id']?>">
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
    // $('.rids').on('click','#rids',function(){
    //     var oldval = $('#arr').val();
    //     var rid = $(this).val();
    //     var arr = oldval+','+rid;
    //     $('#arr').attr('value',arr);
    //     console.log(arr)
    // });
    function btn(){
        var number = document.getElementsByName('check');
        arr = [];
        for(i=0;i<number.length;i++){
            if(number[i].checked){
                arr.push(number[i].value);
            }
        }

        $('#arr').attr('value',arr);
        $.ajax({
            type:'post',
            data:$('#my-form').serialize(),
            dataType:'json',
            url:'<?=url('role/edit')?>',
            success: function(data){
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1})

                    setTimeout(function(){
                        location.href = '<?=url('role/index')?>';
                    },1500)
                }else{
                    layer.msg(data.msg,{icon:5})
                }
            },
            error: function(){
                alert('错误');
            }
        })
    }

</script>
