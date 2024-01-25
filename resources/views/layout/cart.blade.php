<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>
   
    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Giỏ Hàng
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        @php
            $total = 0;
        @endphp
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" style="padding: 0">
                @if (session('carts'))
                    @foreach ($products as $key => $product)
                        {{-- @php
                            $sumPriceCart =$product->price_sale != 0 ? $product->price : $product->price_sale;
                        @endphp --}}
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img" onclick="clickDeleteCart({{ $product->id }})">
                                <img src="{{$product->thumb}}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{$product->name}}
                                </a>

                                <span class="header-cart-item-info" style="display: flex;">
                                    @php
                                        $price = $product->price;
                                        if($product->tbl_price_dicount != null && date("Y/m/d") != str_replace('-','/',$product->tbl_price_dicount->end_at)){
                                            $percent = $product->tbl_price_dicount->percent_price/100;
                                            $discount = $price * $percent;
                                            $result = $price - $discount;
                                            $priceEnd = $result * session('carts')[$product->id];
                                            $total += $priceEnd;
                                        } else{
                                            # code...
                                            $priceEnd = $price * session('carts')[$product->id];
                                            $total += $priceEnd;
                                        }
                                        
                                    @endphp
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
                                </span>
                            </div>
                        </li>          
                    @endforeach
                @endif
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Tổng thành tiền: {{number_format($total)}}đ
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="/carts" style="width: 275px"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Vào giỏ hàng
                    </a>

                    {{-- <a href="/carts" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @section('js')
    <script>
        function clickDeleteCart(id){
            alert(id);
            // $.ajax({
            //     url:"{{ route('deleteCart') }}",
            //     type:"post",
            //     data:{
            //         _token:"{{ csrf_token() }}",
            //         id,
            //     },
            //     success:function(response) {
            //         window.location.reload();
            //     }
            // })
    }
    </script>
@endsection --}}