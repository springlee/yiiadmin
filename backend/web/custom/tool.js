/**
 * Created by springlee on 16/4/12.
 */

var tool={};

    tool.ajaxDelete=function(dom,url){
        parent.layer.confirm('确定要删除吗?', {
            btn: ['确定','取消'], //按钮
            shade: false //不显示遮罩
        }, function(index){
            parent.layer.close(index);
            $.getJSON(url,function(data){
                if(data.status=='1'){
                    dom.remove();
                    toastr.success(data.msg);
                }else{
                    toastr.error(data.msg);
                }
            })
        });
    }
