@extends('layout.home')
@section('content')

    <!--Main Navigation-->
    <!-- Sidebar -->
    <div class="slidebar_option_menu row" style="margin: 80px 0px;">
        <div class="col-3" >
            <div class="con">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a
                        href="#"
                        class="list-group-item list-group-item-action py-2 ripple"
                        aria-current="true"
                        id="qltk"
                        onclick="clickShow(1); return false;"
                    >
                        <i class="fa-solid fa-user fa-fw me-3"></i><span>Quản lý tài khoản</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"  onclick="clickShow(2); return false;" id="lsdh">
                        <i class="fa-solid fa-cart-shopping fa-fw me-3"></i><span>Lịch sử đơn hàng</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"  onclick="clickShow(3); return false;" id="spyt">
                        <i class="fa-solid fa-heart fa-fw me-3"></i><span>Sản phẩm yêu thích</span>
                    </a>
                
                </div>
            </div>
        </div>
        <div class="col-9" style="border: 1px solid;">
            <div class="show_option" data-id="{{ $id }}">
                {{-- @if ($id == 1)
                    <div class="" style="margin: 20px 0">
                        <h4>Tổng quan</h4>
                        <div class="" style="text-align: center; margin-top: 20px">
                            <div class="row" style="display: flex; ">
                                    <div class="col">
                                        <div class="">Tên đăng nhập</div>
                                        <div class="">
                                            <b>
                                                {{ $user->user_customer_name }}
                                            </b>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="">Email</div>
                                        <div class="">
                                            <b>
                                                {{ $user->user_customer_email }}
                                                
                                            </b>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="">Ngày tham gia</div>
                                        <div class="">
                                            <b>
                                                {{ $user->created_at }}
                                                
                                            </b>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                @else
                    
                @endif --}}
            </div>
        </div>
    </div>

    <!-- Sidebar -->


  
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            load();
            function load(){
                var id = $('.show_option').data('id');
                if(id == 1){
                    $.ajax({
                        url:"{{ route('overview') }}",
                        type:'POST',
                        data:{
                            _token:"{{ csrf_token() }}",
                        },
                        success:function(response) {
                            if(response != null){
                                $('.show_option').html(response);
                            }
                        }
                    })
                }else if(id == 2){
                    $.ajax({
                        url:"{{ route('historyOrder') }}",
                        type:'POST',
                        data:{
                            _token:"{{ csrf_token() }}",
                        },
                        success:function(response) {
                            if(response != null){
                                $('.show_option').html(response);
                            }
                        }
                    })
                }else if(id == 3){

                    $.ajax({
                        url:"{{ route('favouriteOrder') }}",
                        type:'POST',
                        data:{
                            _token:"{{ csrf_token() }}",
                        },
                        success:function(response) {
                            if(response != null){
                                $('.show_option').html(response);
                            }
                        }
                    })
                }
            }
        })
        function clickShow(id) {
            if(id == 1){
                $.ajax({
                    url:"{{ route('overview') }}",
                    type:'POST',
                    data:{
                        _token:"{{ csrf_token() }}",
                    },
                    success:function(response) {
                        if(response != null){
                            $('.show_option').html(response);
                        }
                    }
                })
            }else if(id == 2){
                $.ajax({
                    url:"{{ route('historyOrder') }}",
                    type:'POST',
                    data:{
                        _token:"{{ csrf_token() }}",
                    },
                    success:function(response) {
                        if(response != null){
                            $('.show_option').html(response);
                        }
                    }
                })
            }else if(id == 3){
                $.ajax({
                    url:"{{ route('favouriteOrder') }}",
                    type:'POST',
                    data:{
                        _token:"{{ csrf_token() }}",
                    },
                    success:function(response) {
                        if(response != null){
                            $('.show_option').html(response);
                        }
                    }
                })
            }
        }
        
        function clickDetail(id){
            $.ajax({
                url:"{{ route('detailOrder') }}",
                type:"POST",
                data:{
                    _token:"{{ csrf_token() }}",
                    id:id,
                },
                success:function(response){
                    if(response != null){
                        $('.show_option').html(response);
                    }
                }
            })
            
        }
        function clickHeart(id) { 
            
            $('.heart_'+id).attr('style','color: #9ca3af');
            $('.btn_heart_'+id).find('div').css('display','block');

            $('.btn_heart_'+id).find('div').on('click',function() {
                $.ajax({
                    url:"{{ route('deleteFavouriteOrder') }}",
                    type:"POST",
                    data:{
                        _token:"{{ csrf_token() }}",
                        id:id,
                    },
                    success:function(response) {
                        if(response != null){
                            $('.show_option').html(response);
                        }
                        // window.loaction.reload();
                    }
                })
            })
           
            
            var heartTimeout = setTimeout(() => {
                $('.heart_'+id).attr('style','color: #dc3545');
                $('.btn_heart_'+id).find('div').css('display','none');
            }, 5000);
           

        }
        function clickTrashCan(id) {
            $('.btn_trashCan_'+id).find('div').css('display','block');

            $('.btn_trashCan_'+id).find('div').on('click',function() {
                $.ajax({
                    url:"{{ route('deleteFavouriteOrder') }}",
                    type:"POST",
                    data:{
                        _token:"{{ csrf_token() }}",
                        id:id,
                    },
                    success:function(response) {
                        if(response != null){
                            $('.show_option').html(response);
                        }
                        // window.loaction.reload();
                    }
                })
            })
            var heartTimeout = setTimeout(() => {
                $('.btn_trashCan_'+id).find('div').css('display','none');
            }, 5000);
        }
        
        function clickAddCart(id,sl){
            var quantity = $('.num-product').val();
            // $(':disabled').css("display","none");
            if(quantity <= sl){
                $.ajax({
                    url:"{{ route('addtoCart') }}",
                    type:"POST",
                    data:{
                        _token:"{{ csrf_token() }}",
                        id:id,
                        quantity:quantity,
                    },
                    success:function(response) {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc đến giỏ hàng để thanh toán",
                                icon: "success",
                                buttons:["Xem tiếp","Đến trang giỏ hàng"],
                                // dangerMode: true,
                            })
                            .then((e) => {
                                if (e) {
                                    window.location.href =  "{{ route('showCart') }}"
                                }else{
                                    window.location.reload();
                                }
                            });
                    }
                });
            }else{
                swal({
                    title: "Vui lòng kiểm tra",
                    text: "Số lượng sản phẩm khách hàng đặt vượt quá số lượng tồn !",
                    icon: "warning",
                    buttons: 'Ok',
                })
            }
        }
    </script>
@endsection