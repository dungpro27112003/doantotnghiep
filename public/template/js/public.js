$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore() {
    const page = parseInt($('#page').val());
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: { 
            page,
            _token:$('meta[name="csrf-token"]').attr('content'),
        },
        url: '/services/load-product',
        success: function (result) {
            if(result.html !== ''){
                $('#loadProducts').append(result.html);
                $('#page').val(page+1);
                console.log('Current page:', page);
                console.log('Number of products:', result.length);
            }else{
                // alert('Đã load xong sản phẩm');
                $('#btn-loadmore').css('display','none');
            }
        },
        error: function () {
            alert('Có lỗi xảy ra khi tải sản phẩm.');
        }
    });
}