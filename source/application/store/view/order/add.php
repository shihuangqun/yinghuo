<link rel="stylesheet" href="assets/store/css/goods.css">
<link rel="stylesheet" href="assets/store/plugins/umeditor/themes/default/css/umeditor.css">
<link type="text/css" href="assets/store/css/base.css" rel="stylesheet" />


<style>

</style>
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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商品编码 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="goods_no"
                                           value="" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">主产品 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择主产品'}" id="goods">
                                        <option value=""></option>
                                        <?php if (isset($cate)): foreach($cate as $item): ?>
                                        <option value="<?= $item['name']?>" disabled="disabled">
                                            <?= $item['name']?></option>
                                        <?php if (!empty($item['sub'])): foreach($item['sub'] as $it): ?>
                                            <option value="<?= $it['category_id']?>">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $it['name']?></option>
                                            <?php endforeach; endif;?>

                                        <?php endforeach; endif;?>

                                    </select>
                                    <label class=" am-form-label form-require">配件 </label>
                                    <select required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择配件'}" id="parts">
                                        <option value=""></option>
                                        <?php if (isset($cates)): foreach($cates as $item): ?>
                                            <option value="<?= $item['name']?>" disabled="disabled">
                                                <?= $item['name']?></option>
                                            <?php if (!empty($item['sub'])): foreach($item['sub'] as $it): ?>
                                                <option value="<?= $it['category_id']?>">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $it['name']?></option>
                                            <?php endforeach; endif;?>

                                        <?php endforeach; endif;?>

                                    </select>
                                </div>
                                <input type="hidden" name="goods_id" id="goods_id" value="">
                                <input type="hidden" name="parts_id[]" id="parts_id" value="">
                            </div>

                            <div class="iteminfo_buying" style="display: none">

                                <!--规格属性-->

                                <div class="sys_item_spec" style="margin-left:10%">
                                    <dl class="clearfix iteminfo_parameter sys_item_specpara" data-sid="1">

                                        <dt>主产品</dt>

                                        <dd>

                                            <ul class="sys_spec_img product">

                                            </ul>


                                        </dd>


                                    </dl>


                                       <dl class="clearfix iteminfo_parameter sys_item_specpara" data-sid="1">

                                           <dt>配件</dt>

                                           <dd>

                                               <ul class="sys_spec_img parts parts" style="display: none">

                                               </ul>


                                           </dd>


                                       </dl>



                                </div>

                                <!--规格属性-->

                            </div>
<!--                            <div class="am-form-group">-->
<!--                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单价 </label>-->
<!--                                <div class="am-u-sm-9 am-u-end">-->
<!--                                    <input type="number" class="tpl-form-input" name="goods[spec][goods_price]"-->
<!--                                           required>-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">数量 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="num"
                                           required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">订单金额 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="pay_price"
                                           required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">延保服务 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="guarantee_id" required
                                            data-am-selected="{searchBox: 1, btnSize: 'sm',  placeholder:'请选择延保服务'}">
                                        <option value=""></option>
                                        <?php if (isset($guarantee)): foreach($guarantee as $item): ?>
                                            <option value="<?= $item['id']?>"><?= $item['term']?>（<?= $item['price']?>）</option>


                                        <?php endforeach; endif;?>

                                    </select>
                                    <small class="am-margin-left-xs">
                                        <a href="<?= url('guarantee/add') ?>">去添加</a>
                                    </small>
                                </div>
                            </div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">收货信息</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">姓名 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="name"
                                           value="" required>
                                </div>
                            </div><div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">电话 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="phone"
                                           value="" required>
                                </div>
                            </div>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">商品详情</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">商品详情 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <!-- 加载编辑器的容器 -->
                                    <textarea id="container" name="content" type="text/plain"></textarea>
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
        $.ajax({
            type:'post',
            data:$('#my-form').serialize(),
            dataType:'json',
            url:"<?=url('order/doadd')?>",
            success: function(data){
                console.log(data);
                if(data.code == 200){
                    layer.msg(data.msg,{icon:1});

                    setTimeout(function(){
                        location.href = '<?=url('order/all_list')?>';
                    },1500)
                }else{
                    layer.msg(data.msg,{icon:5});
                }
            },
            error: function(){
                console.log('错误');
            }
        })
    }
    $('#goods').change(function(){
        id = $('#goods option:selected') .val();//选中的值
        // console.log(select);

        $.ajax({
            type:'post',
            data:{id:id},
            dataType:'json',
            url:"<?=url('order/goods')?>",
            success: function(data){
                // console.log(data);
                $('.iteminfo_buying').css('display','block')

                json = eval(data);
                var html ='';
                $.each(json,function(index,item){
                    html += `<li data-aid="3" data-id="${json[index].goods_id}" ><a href="javascript:;" title="白色"><img src="uploads/${json[index].file_name}" alt="白色" /></a><i></i></li>`;

                    $('.product').html(html);


                })

            },
            error: function(){
                console.log('服务器错误');
            }
        })
    });
    $('#parts').change(function(){
        id = $('#parts option:selected') .val();//选中的值
        // console.log(id);

        $.ajax({
            type:'post',
            data:{id:id},
            dataType:'json',
            url:"<?=url('order/goods')?>",
            success: function(data){
                // console.log(data);
                $('.parts').css('display','block')

                json = eval(data);
                var html ='';
                $.each(json,function(index,item){
                    html += `<li data-aid="3" data-id="${json[index].goods_id}"><a href="javascript:;" title="白色"><img src="uploads/${json[index].file_name}" alt="白色" /></a><i></i></li>`;

                    $('.parts').html(html);


                })

            },
            error: function(){
                console.log('服务器错误');
            }
        })
    });

    $(document).on("click",'.product li',function(){
        // console.log($(this))
        var i=$(this);
        if(!!$(this).hasClass("selected")){

            $(this).removeClass("selected");

            i.removeAttr("data-attrval");

        }else{

            $(this).addClass("selected").siblings("li").removeClass("selected");
            goods_id = $(this).attr('data-id');
            $('#parts_id').attr('value',goods_id);

            i.attr("data-attrval",$(this).attr("data-aid"))

        }
    })
    $(document).on("click",'.parts li',function(){
        // console.log($(this))
        var i=$(this);
        if(!!$(this).hasClass("selected")){

            $(this).removeClass("selected");

            i.removeAttr("data-attrval");

        }else{

            // $(this).addClass("selected").siblings("li").removeClass("selected");
            $(this).addClass("selected");

            id = $('#parts_id').val();

            goods_id = $(this).attr('data-id');

            if($.trim(id) != ''){
                goods_id = id+','+$(this).attr('data-id');

            }

            $('#parts_id').attr('value',goods_id);

            i.attr("data-attrval",$(this).attr("data-aid"))

        }
    })
</script>
<script>
    //价格json

    var sys_item={

        "mktprice":"13.00",

        "price":"6.80",

        "sys_attrprice":{"3_13":{"price":"6.80","mktprice":"13.00"},"3_14":{"price":"7.80","mktprice":"14.00"},"3_16":{"price":"8.80","mktprice":"15.00"},"3_17":{"price":"9.80","mktprice":"16.00"},"4_13":{"price":"6.80","mktprice":"13.00"},"4_14":{"price":"7.80","mktprice":"14.00"},"4_16":{"price":"8.80","mktprice":"15.00"},"4_17":{"price":"9.80","mktprice":"16.00"},"8_13":{"price":"6.80","mktprice":"13.00"},"8_14":{"price":"7.80","mktprice":"1400"},"8_16":{"price":"8.80","mktprice":"15.00"},"8_17":{"price":"9.80","mktprice":"16.00"},"9_13":{"price":"6.80","mktprice":"13.00"},"9_14":{"price":"7.80","mktprice":"14.00"},"9_16":{"price":"8.80","mktprice":"15.00"},"9_17":{"price":"9.80","mktprice":"16.00"},"10_13":{"price":"6.80","mktprice":"13.00"},"10_14":{"price":"7.80","mktprice":"14.00"},"10_16":{"price":"8.80","mktprice":"15.00"},"10_17":{"price":"9.80","mktprice":"16.00"},"12_13":{"price":"6.80","mktprice":"13.00"},"12_14":{"price":"7.80","mktprice":"14.00"},"12_16":{"price":"8.80","mktprice":"15.00"},"12_17":{"price":"9.80","mktprice":"16.00"}}};





    //商品规格选择

    $(function(){

        $(".sys_item_spec .sys_item_specpara").each(function(){

            var i=$(this);

            var p=i.find("ul>li");

            p.click(function(){

                if(!!$(this).hasClass("selected")){

                    $(this).removeClass("selected");

                    i.removeAttr("data-attrval");

                }else{

                    $(this).addClass("selected").siblings("li").removeClass("selected");

                    i.attr("data-attrval",$(this).attr("data-aid"))

                }

                getattrprice() //输出价格

            })

        })



        //获取对应属性的价格

        function getattrprice(){

            var defaultstats=true;

            var _val='';

            var _resp={

                mktprice:".sys_item_mktprice",

                price:".sys_item_price"

            }  //输出对应的class

            $(".sys_item_spec .sys_item_specpara").each(function(){

                var i=$(this);

                var v=i.attr("data-attrval");

                if(!v){

                    defaultstats=false;

                }else{

                    _val+=_val!=""?"_":"";

                    _val+=v;

                }

            })

            if(!!defaultstats){

                _mktprice=sys_item['sys_attrprice'][_val]['mktprice'];

                _price=sys_item['sys_attrprice'][_val]['price'];

            }else{

                _mktprice=sys_item['mktprice'];

                _price=sys_item['price'];

            }

            //输出价格

            $(_resp.mktprice).text(_mktprice);  ///其中的math.round为截取小数点位数

            $(_resp.price).text(_price);

        }

    })

</script>