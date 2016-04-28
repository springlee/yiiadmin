
function detailFormatter(index, row) {
    var url='/menu/menuchild?id='+row.id;
    var str='';
    $.ajax({
        type:"GET",
        url:url,
        async:false,
        success:function(data){
           str=getSonStr(data)
        }
    })
    return str;
}
function operateFormatterMenu(value, row, index) {
    console.log(value);
    console.log(row);
    console.log(index);
    return [
        '<a class="edit" href="/menu/menuupdate/'+row.id+'" title="edit">',
        '[编辑]',
        '</a>  ',
        '<a class="remove" href="javascript:void(0)" title="Remove" data-url="/memu/menudelete/'+row.id+'">',
        '[删除]',
        '</a>'
    ].join('');
}

function operateFormatterUser(value, row, index) {
    return [
        '<a class="edit" href="/user/userupdate/'+row.id+'" title="edit">',
        '[编辑]',
        '</a>  ',
        '<a class="remove" href="javascript:void(0)" title="Remove" data-url="/user/userdelete/'+row.id+'">',
        '[删除]',
        '</a>'
    ].join('');
}

function getSonStr(data){
    var str ="";
    str += "<div class='box-body'>";
    str += "<table  class='table table-striped table-vmiddle'>";
    str += "<thead>";
    str += "<tr>";
    str += "<th >ID</th>";
    str += "<th >菜单名称</th>";
    str += "<th >地址</th>";
    str += "<th >权限</th>";
    str += "<th >创建时间</th>";
    str += "<th >更新时间</th>";
    str += "<th >操作</th>";
    str += "</tr>";
    str += "</thead>";
    str += "<tbody>";
    for(var i = 0;i<data.length;i++){
        str += "<tr>";
        str += "<td>"+data[i].id+"</td>";
        str += "<td>"+data[i].name+"</td>";
        str += "<td>"+data[i].url+"</td>";
        str += "<td>"+data[i].slug+"</td>";
        str += "<td>"+data[i].created_at+"</td>";
        str += "<td>"+data[i].updated_at+"</td>";
        str += "<td>";
        str += operateFormatter('',data[i],'');
        str += "</td>";
        str += "</tr>";
    }
    str += "</tbody>";
    str += "</table>";
    str += "</div>";
    return str;
}
$(document).on('click','.remove',function(){
    var url=$(this).data('url');
    tool.ajaxDelete($(this).parents('tr'),url);
})