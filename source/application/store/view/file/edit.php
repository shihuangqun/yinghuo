<link rel="stylesheet" href="assets/store/css/goods.css">
<link rel="stylesheet" href="assets/store/plugins/umeditor/themes/default/css/umeditor.css">


<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">基本信息</div>
                            </div>
                            <!--                            <div class="am-form-group">-->
                            <!--                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品名称 </label>-->
                            <!--                                <div class="am-u-sm-9 am-u-end">-->
                            <!--                                    <input type="text" class="tpl-form-input" name="goods[goods_name]"-->
                            <!--                                           value="" required>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">标题 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="title"
                                           value="<?= $edit['title']?>" required>
                                </div>
                            </div>
<!--                            <div class="am-form-group">-->
<!--                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">关联商品 </label>-->
<!--                                <div class="am-u-sm-9 am-u-end">-->
<!--                                    <select name="product_id" required-->
<!--                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择需要关联的商品'}">-->
<!--                                        <option value=""></option>-->
<!--                                        --><?php //if (isset($cate)): foreach($cate as $item): ?>
<!--                                            <option value="--><?//= $item['name']?><!--">--><?//= $item['name']?><!--</option>-->
<!--                                            --><?php //if (!empty($item['sub'])): foreach($item['sub'] as $it): ?>
<!--                                                <option value="--><?//= $it['goods_id']?><!--">-->
<!--                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><?//= $it['goods_name']?><!--</option>-->
<!--                                            --><?php //endforeach; endif;?>
<!---->
<!--                                        --><?php //endforeach; endif;?>
<!---->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">文件 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="file" name="file" value="<?= $edit['file']?>" required>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $edit['id']?>">





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

<!-- 图片文件列表模板 -->
{{include file="layouts/_template/tpl_file_item" /}}

<!-- 文件库弹窗 -->
{{include file="layouts/_template/file_library" /}}

<!-- 商品多规格模板 -->
{{include file="goods/_template/spec_many" /}}

<script src="assets/store/js/ddsort.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.config.js"></script>
<script src="assets/store/plugins/umeditor/umeditor.min.js"></script>
<script src="assets/store/js/goods.spec.js"></script>
<script>
    $(function () {

        // 富文本编辑器
        UM.getEditor('container');
        //
        // 选择图片
        $('.upload-file').selectImages({
            name: 'goods[images][]'
            , multiple: true
        });

        // 图片列表拖动
        $('.uploader-list').DDSort({
            target: '.file-item',
            delay: 100, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
            floatStyle: {
                'border': '1px solid #ccc',
                'background-color': '#fff'
            }
        });

        // 注册商品多规格组件
        var specMany = new GoodsSpec({
            container: '.goods-spec-many'
        });

        // 切换单/多规格
        $('input:radio[name="goods[spec_type]"]').change(function (e) {
            var $goodsSpecMany = $('.goods-spec-many')
                , $goodsSpecSingle = $('.goods-spec-single');
            if (e.currentTarget.value === '10') {
                $goodsSpecMany.hide() && $goodsSpecSingle.show();
            } else {
                $goodsSpecMany.show() && $goodsSpecSingle.hide();
            }
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm({
            // form data
            buildData: function () {
                return {
                    goods: {
                        spec_many: specMany.getData()
                    }
                };
            },
            // 自定义验证
            validation: function () {
                var specType = $('input:radio[name="goods[spec_type]"]:checked').val();
                if (specType === '20') {
                    var isEmpty = specMany.isEmptySkuList();
                    isEmpty === true && layer.msg('商品规格不能为空');
                    return !isEmpty;
                }
                return true;
            }
        });


    });
    function btn(){

        var form = document.getElementById('my-form');
        var formData = new FormData(form);
        // console.log($('#my-form').serialize());
        $.ajax({
            type: 'post',
            data: formData,
            dataType: 'json',
            processData:false,
            contentType: false,
            url: '<?= url('file/doedit')?>',
            success: function(data){
                console.log(data);
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1});
                    setTimeout(function(){
                        location.href = '<?= url('file/index')?>';
                    },1500)
                }else{
                    layer.msg(data.msg,{icon:5});
                }
            },
            error: function(){
                alert('错误');
            }
        })

    }


</script>
