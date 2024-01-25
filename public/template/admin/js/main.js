$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url){
    if(confirm('Bạn có muốn xoá sản phẩm này vĩnh viễn không?')){
        $.ajax({
            type:'DELETE',
            datatype:'JSON',
            data:id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:url,
            success:function(result){
                if(result.error ===false){
                    alert(result.message);
                    location.reload();
                }else{
                    alert('Đã xảy ra vấn đề lỗi xin vui lòng thử lại');
                }
            }
        })
    }
}

/*Upload file */

$('#upload').change(function(){
    const form = new FormData();
    form.append('file',$(this)[0].files[0]);
    $.ajax({
        processData:false,
        contentType:false,
        url:'/admin/upload/services',
        type:'POST',
        dataType:'JSON',
        data:form,
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(results){
            if(results.error===false){
                $('#image_show').html('<a href="'+results.url+'" target="_blank">'+
                '<img src="'+results.url+'" width="100px"></a>');
                $('#thumb').val(results.url);
            }else{
                alert('Upload file lỗi');
            }
        }
    });
});