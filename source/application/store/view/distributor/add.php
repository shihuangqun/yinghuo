
<link rel="stylesheet" href="assets/UI/layui/layui-v2.4.5/layui/css/layui.css">
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
<!--                <form class="layui-form layui-form-pane am-form tpl-form-line-form" action="" id="my-form">-->
                <form id="my-form" class="am-form tpl-form-line-form" enctype="multipart/form-data" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">经销商添加</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 用户名 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="name"
                                           value="" required>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="am-u-sm-3 am-form-label form-require"> 地区 </label>
                                <div class="layui-input-inline">
                                    <select  id="sheng">
                                        <option value="">请选择省</option>
                                    </select>
                                </div>


                            </div>
                            <input type="hidden" name="adds" value="" id="adds">
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
<!--                </form>-->
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
            url:'<?=url('distributor/add')?>',
            success: function(data){
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1})

                    setTimeout(function(){
                        location.href = '<?=url('distributor/index')?>';
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
                var adds = $("select option:selected").text();
                $('#adds').attr('value',adds);
                // console.log(data);
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
