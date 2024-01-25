<div class="row isotope-grid show_ProductFilter">
    @foreach ($products as $key => $product)
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img style="height: 180px; object-fit: contain; border: 1px solid #1111" src="{{ $product->thumb }}" alt="{{ $product->name }}">

                {{-- <a href="#"
                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                            Quick View
                        </a> --}}
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 ">
                        {{ $product->name }}
                    </a>

                    <span class="stext-105 cl3" style="display: flex;">
                        @if (!empty($product->tbl_price_dicount) && date("Y/m/d") !== str_replace('-','/',$product->tbl_price_dicount->end_at))
                            @php
                            $price = $product->price;
                            $percent = $product->tbl_price_dicount->percent_price/100;
                            $discount = $price * $percent;
                            $total = $price - $discount;
                            @endphp
                        <div style="font-weight: 600; margin-left: 5px;">{{ number_format($total)}}đ</div>
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
                {{-- {{ dd($product->favourite[$key]) }} --}}
                {{-- {{ dd($product->favourite[0]->product_id) }} --}}
                {{-- {{ var_dump(dd($product->favourite)) }} --}}
                <div class="block2-txt-child2 flex-r p-t-3">
                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" onclick="btn_addheart({{ $product->id }},'{{ $product->name }}',{{ !empty(session('user_customer_id')) ? session('user_customer_id') : 0  }}); return false;">
                        <img class="icon-heart1 dis-block trans-04" id="heart1_{{ $product->id }}" style="opacity: 1;" src="/template/images/icons/icon-heart-01.png" alt="ICON">
                        @php
                            $html ='<img class="icon-heart2 dis-block trans-04 ab-t-l" id="heart2_'.$product->id.'"';
                            if(!empty(session('user_customer_id'))){ 
                                foreach ($product->favourite as $key => $item) {
                                    if ($product->id == $item->product_id && session('user_customer_id') == $item->user_customer_id) {
                                        $html.='
                                            style="opacity:1"
                                        ';
                                    }
                                }
                            }
                            $html .= 'src="/template/images/icons/icon-heart-02.png" alt="ICON">';
                            echo $html;
                        @endphp
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>