/**
 * Created by admin on 2017/2/22.
 */
function promptmessage(url,name){
    layer.confirm(
        '你确定要'+name+'嘛？',
        {
            icon:1,
            title:'提示',
        },
        function(index){
            window.location.href = url;
            layer.close(index);
        });
}