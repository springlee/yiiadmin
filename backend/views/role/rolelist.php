<?php

use backend\assets\AppAsset;
AppAsset::addScript($this,'@web/custom/table.js');
?>
<div class="card">
    <div class="card-header">
        <h2>角色列表</h2>
    </div>
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
           data-url="/role/rolelist/"
        >
        <thead>
        <tr>
            <th data-field="name">角色名称</th>
            <th data-field="description">描述</th>
            <th data-field="created_at" data-sortable="true">创建时间</th>
            <th data-field="updated_at">更新时间</th>
            <th data-field="commands" data-formatter="operateFormatterRole">操作</th>
        </tr>
        </thead>
    </table>

</div>