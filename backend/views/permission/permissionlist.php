<?php

use backend\assets\AppAsset;
AppAsset::addScript($this,'@web/custom/table.js');
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>权限列表</h5>
    </div>
    <div class="ibox-content">
    <table data-toggle="table"
           data-search="true"
           data-show-refresh="true"
           data-show-columns="true"
           data-minimum-count-columns="2"
           data-show-pagination-switch="true"
           data-pagination="true"
           data-page-list="[10, 25, 50, 100, ALL]"
           data-show-footer="false"
           data-side-pagination="server"
           data-url="/permission/permissionlist/"
        >
        <thead>
        <tr>
            <th data-field="typename">权限类型名称</th>
            <th data-field="name">权限</th>
            <th data-field="description">描述</th>
            <th data-field="created_at" data-sortable="true">创建时间</th>
            <th data-field="updated_at">更新时间</th>
            <th data-field="commands" data-formatter="operateFormatterPermission">操作</th>
        </tr>
        </thead>
    </table>
    </div>
</div>