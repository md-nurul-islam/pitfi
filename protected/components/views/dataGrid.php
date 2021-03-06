
<!--<link rel="stylesheet" type="text/css" href="../DataGrid/themes/bootstrap/easyui.css">-->
<!--<link rel="stylesheet" type="text/css" href="../DataGrid/themes/icon.css">-->
<!--<link rel="stylesheet" type="text/css" href="../demo.css">-->
<!--        <script type="text/javascript" src="../../jquery.min.js"></script>-->


<?php
Yii::app()->clientScript->registerCoreScript('jquery');
$baseUrl = Yii::app()->request->getBaseUrl(true);
$cs = Yii::app()->getClientScript();

$cs->registerCssFile($baseUrl . '/js/datagrid/themes/bootstrap/easyui.css');
$cs->registerCssFile($baseUrl . '/js/datagrid/themes/icon.css');

$cs->registerScriptFile($baseUrl . '/js/datagrid/jquery.easyui.min.js', CClientScript::POS_HEAD);
$cs->registerScriptFile($baseUrl . '/js/datagrid/filter/datagrid-filter.js', CClientScript::POS_HEAD);
?>

<div class="clearfix"></div>

<div class="col-lg-12">

    <div id="filters" style="padding:5px; height:auto">
        <!--        <div style="margin-bottom:5px">
                    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true"></a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true"></a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true"></a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-cut" plain="true"></a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true"></a>
                </div>-->

        <?php
        if (!empty($this->filters)) {
            ?>

            <div>
                <?php foreach ($this->filters as $key => $val) { ?>
                    <?php if (isset($val['label']) && !empty($val['label'])) { ?>
                        <label for="<?php echo $val['id']; ?>">
                            <?php echo $val['label']; ?>
                        </label>
                        <input field="<?php echo $key; ?>" <?php
                        echo (implode(' ', array_map(function($key) use ($val) {
                                    return $key . '=' . '"' . $val[$key] . '"';
                                }, array_keys($val))));
                        ?> />
                           <?php } ?>
                       <?php } ?>
                <a href="#" class="btn btn-success" iconCls="icon-search" onclick="doSearch();">Search</a>
            </div>
        <?php } ?>
    </div>

    <table id="dg" class="table table-bordered table-hover table-responsive" style="height:auto;"
           data-options="
           rownumbers:true,
           singleSelect:true,
           autoRowHeight:false,
           striped:true,
           pagination:<?php echo $this->enablePagination; ?>,
           pageSize:<?php echo $this->pageSize; ?>" url="<?php echo $this->url; ?>" 
           toolbar="#filters"
           iconCls="icon-save"
           fitColumns="true"
           >
        <thead>
            <tr>
                <?php foreach ($this->headers as $key => $val) { ?>
                    <?php if (isset($val['label']) && !empty($val['label'])) { ?>
                        <th field="<?php echo $key; ?>" <?php
                        echo (implode(' ', array_map(function($key) use ($val) {
                                    return $key . '=' . '"' . $val[$key] . '"';
                                }, array_keys($val))));
                        ?>>
                            <label>
                                <?php echo $val['label']; ?>
                            </label>
                        </th>
                    <?php } ?>
                <?php } ?>
            </tr>
        </thead>
    </table>
</div>

<div class="clearfix"></div>

<script type="text/javascript">

    $(function () {
        var dg = $('#dg').datagrid();
        dg.datagrid('getPager').pagination({
            layout: ['first', 'prev', 'links', 'next', 'last', 'refresh'],
        });
    });
    
    function doSearch() {
        $('#dg').datagrid('reload', {
            <?php foreach ($this->filters as $key => $filter) { ?>
                <?php if ($filter['class'] != 'easyui-combobox') { ?>
                    <?php echo $key . ': $("#' . $key . '").val(),'; ?>
                <?php } else { ?>
                    <?php echo $key . ': $("#' . $key . '").combobox("getValue"),'; ?>
                <?php } ?>
            <?php } ?>
        });
    }
    
    $(window).load(function () {
        $('.datagrid-header-inner .datagrid-htable').css('width', '100%');
    });

</script>

<style type="text/css">
    .combo-panel div {
        cursor: pointer;
    }
</style>