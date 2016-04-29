<?php
use backend\assets\AppAsset;
AppAsset::addScript($this,'@web/custom/table.js');
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>菜单列表</h5>
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
           data-url="/user/userlist/"
        >
        <thead>
        <tr>
            <th data-field="id">ID</th>
            <th data-field="username">用户名</th>
            <th data-field="email">邮箱</th>
            <th data-field="commands" data-formatter="operateFormatterUser">操作</th>
        </tr>
        </thead>
    </table>
    </div>
</div>
