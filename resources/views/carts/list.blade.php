@extends('layout.home')

@section('content')
    <div class="container p-t-60">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $title }}
            </span>
        </div>
    </div>
    @if (count($products) != 0)

            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <form action="{{ route('updateCart') }}" method="post">
                                @csrf
                                <div class="wrap-table-shopping-cart">
                                    <table class="table-shopping-cart">
                                        <tbody>
                                            <tr class="table_head">
                                                <th class="column-1">Sản phẩm</th>
                                                <th class="column-2"></th>
                                                <th class="column-3">Giá sản phẩm</th>
                                                <th class="column-4">Số lượng</th>
                                                <th class="column-5">Tổng tiền</th>
                                                {{-- <th class="column-6">&nbsp;</th> --}}
                                            </tr>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($products as $key => $product)
                                                @php
                                                    // dd($product);
                                                    $price = $product->price ;
                                                    if($product->tbl_price_dicount != null && date("Y/m/d") != str_replace('-','/',$product->tbl_price_dicount->end_at)){
                                                        $percent = $product->tbl_price_dicount->percent_price/100;
                                                        $discount = $price * $percent;
                                                        $result = $price - $discount;
                                                        if ( session('coupon')!=null ) {
                                                            # code...
                                                            $priceEnd = $result * $carts[$product->id]-session('coupon')[session('user_customer_id')]['coupon_discount'];
                                                            $total += $priceEnd;
                                                        }else{
                                                            $priceEnd = $result * $carts[$product->id];
                                                            $total += $priceEnd;
                                                        }
                                                    } else{ 
                                                        if (session('coupon')!=null) {
                                                            # code...
                                                            $priceEnd = $price * $carts[$product->id]-session('coupon')[session('user_customer_id')]['coupon_discount'];
                                                            $total += $priceEnd;
                                                        } else{
                                                            # code...
                                                            $priceEnd = $price * $carts[$product->id];
                                                            $total += $priceEnd;
                                                        }
                                                    }
                                                @endphp
    
                                                <tr class="table_row">
                                                    <td class="column-1">
                                                        <div class="how-itemcart1" onclick="clickDeleteCart({{ $product->id }})">
                                                            <img src="{{ $product->thumb }}" alt="IMG">
                                                        </div>
                                                    </td>
                                                    <td class="column-2">{{ $product->name }}</td>
                                                    <td class="column-3">
                                                        {{-- {{ number_format($price, 0, '.') }}đ --}}
                                                        @if (!empty($product->tbl_price_dicount) && date("Y/m/d") != str_replace('-','/',$product->tbl_price_dicount->end_at))
                                                            <div style="font-weight: 600; margin-left: 5px;">{{ number_format($result)}}đ</div>
                                                            <div style="display: flex; align-items: center;">
                                                                <div style="font-weight: 600; margin-left: 5px; text-decoration-line: line-through; color: #9ca3af;">{{ number_format($product->price) }}đ</div>
                                                                <div style="margin-left: 5px; background-color: #dc3545;border-radius: 7px">
                                                                    <small style="color: white; font-weight: 600;
                                                                    padding: 5px 5px 0px 6px;">-{{ $product->tbl_price_dicount->percent_price }}%</small>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div style="font-weight: 600; margin-left: 5px;"> {!! App\Helpers\Helper::price($product->price) !!}đ</div>
                                                        @endif
                                                    </td>
                                                    <td class="column-4">
                                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                                            </div>
                                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                                {{-- name="num_product[{{ $product->id }}]" --}}
                                                                min="1"
                                                                name="num_product_{{ $product->id }}"
                                                                value="{{ $carts[$product->id] }}">
                                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="column-5">{{ number_format($priceEnd, 0, '.') }}đ</td>
                                                    {{-- <td class="column-6 p-r-15">
                                                        <a href="/carts/delete/{{ $product->id }}">Xoá</a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
    
                                <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                    <div class="flex-w flex-m m-r-20 m-tb-5">
                                        <form method="post">
                                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 input_coupon" type="text"
                                            name="coupon" placeholder="Mã giảm giá" value="{{ old('coupon')??session('msg')!=null?session('msg'):""  }}">
                                            
                                            <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                                <button type="button" class="btn_applycoupon">Áp dụng</button>
                                            </div>
                                                @if (session('msgcode'))
                                                    <span><p style="color: red">{{ session('msgcode') }}</p></span>
                                                @endif 
                                        </form>
                                    </div>
                                    
                                    <input type="submit" value="Cập nhật giỏ hàng" formaction="/update-cart"
                                        class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" />
                                    
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                                <form  action="{{ route('addCart') }}" method="POST">
                                    @csrf
                                    <h4 class="mtext-109 cl2 p-b-30">
                                        Thanh toán
                                    </h4>

                                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                        <div class="size-208 w-full-ssm">
                                            <span class="stext-110 cl2">
                                                Thông tin khách hàng
                                            </span>
                                        </div>

                                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                        
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="order_name" value="{{old("name") ?? $userCustomer->user_customer_name}}"
                                                    placeholder="Tên khách hàng"  />
                                                    @error('order_name')
                                                        <span style="color: red"> {{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="order_phone"
                                                    placeholder="Số điện thoại"  value="{{ old('order_phone') }}" />
                                                    @error('order_phone')
                                                        <span style="color: red"> {{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="order_address"
                                                    placeholder="Địa chỉ nhận hàng" value="{{ old('order_address') }}" />
                                                    @error('order_address')
                                                        <span style="color: red"> {{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="order_email"
                                                    placeholder="Email" value="{{old("email") ?? $userCustomer->user_customer_email}}"/>
                                                    @error('order_email')
                                                        <span style="color: red"> {{ $message }}</span>
                                                    @enderror
                                            </div>
                                            
                        

                                            
                                            {{-- <div class="bor8 bg0 m-b-12">
                                                <textarea class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="content" placeholder="Ghi chú"></textarea>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="flex-w flex-t p-t-27 p-b-33">
                                        <div class="size-208">
                                            <span class="mtext-101 cl2">
                                                Tổng:
                                            </span>
                                        </div>

                                        <div class="size-209 p-t-1">
                                            <span class="mtext-110 cl2">
                                                {{ number_format($total, 0, '.') }}đ
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_customer_id" value="{{ $userCustomer->user_customer_id }}">
                                    @foreach ($products as $key => $item)
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    @endforeach
                                    <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 ">
                                        Thanh toán
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
    @else
        <div class="text-center">
            <h2>Giỏ hàng trống</h2>
        </div>
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
            <h6 style="text-align: center">Thêm sản phẩm vào giỏ và quay lại trang này để thanh toán nha bạn </h6>
            <div style="justify-content: center;" class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm border-top">
                <img  src="https://cdn.divineshop.vn/static/4e0db8ffb1e9cac7c7bc91d497753a2c.svg" alt="">
            </div>
        </div>
        {{-- <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">

            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm border-top">

                <div class="flex-w flex-m m-r-20 m-tb-5">

                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon"
                        placeholder="Coupon Code">

                    <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                        Thêm mã giảm giá
                    </div>
                </div>

                <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                    <a href="/" style="color: black">
                        Cập nhật giỏ hàng
                    </a>
                </div>
            </div>
        </div> --}}
    @endif
@endsection
@section('js')
    <script>
        function clickDeleteCart(id){
            $.ajax({
                url:"{{ route('deleteCart') }}",
                type:"post",
                data:{
                    _token:"{{ csrf_token() }}",
                    id,
                },
                success:function(response) {
                    window.location.reload();
                }

            })
        }
        $(document).ready(function() {
            $('.btn_applycoupon').on('click',function(){
                var coupon =  $('.input_coupon').val();
                $.ajax({
                    url:"{{ route('checkCoupon') }}",
                    type:"POST",
                    data:{
                        _token:"{{ csrf_token() }}",
                        coupon:coupon,
                    },
                    success:function(response) {
                        window.location.reload();
                    }
                })
            })
        })
    </script>
@endsection