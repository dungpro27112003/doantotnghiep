@extends('layout.home')
@section('content')
    <div class="container p-t-80">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="/danh-muc/{{ $product->menu->id }}-{{ Str::slug($product->menu->name) }}.html"
                class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product->menu->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $title }}
            </span>
        </div>
    </div>
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
    </header>

    <!-- Cart -->


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                            <div class="slick3 gallery-lb">
                                @foreach ($product->tbl_image_product as $item)
                                    <div class="item-slick3" data-thumb="{{ $item->image_link }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ $item->image_link }}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ $item->image_link }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                    
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        Sản phẩm
                        <h3 class="mtext-105 cl2 js-name-detail p-b-14">
                            <b> {{ $product->name }}</b>
                        </h3>
                        <p>
                            <i class="fa-solid fa-box"></i>
                            Tình trạng: 
                            @if ($product->product_quantity > 0)
                                <span style="color: #83b474">Còn hàng ({{ $product->product_quantity }})</span>
                            @else
                                <span style="color: red">Hết hàng({{ $product->product_quantity }})</span>
                            @endif
                        </p>
                        @if (!empty($pricediscount) && date("Y/m/d") != str_replace('-','/',$pricediscount->end_at))
                            <p>
                                <i class="fa-solid fa-calendar-days"></i>
                                Ngày hết khuyến mãi: 
                                    <span style="color: #83b474">{{ str_replace('-','/',$pricediscount->end_at) }}</span>
                            </p>
                        @endif
                        <span class="mtext-106 cl2">
                            @if (!empty($pricediscount) && date("Y/m/d") != str_replace('-','/',$pricediscount->end_at))
                                @php
                                    $price = $product->price;
                                    $percent = $pricediscount->percent_price/100;
                                    $discount = $price * $percent;
                                    $total = $price - $discount;
                                @endphp
                                <h4 style="font-weight: 600">{{ number_format($total)}}đ</h4>
                                <div style="display: flex; align-items: center;">
                                    <h6 style=" font-size:17px;font-weight: 600; text-decoration-line: line-through; color: #9ca3af;">{{ number_format($product->price) }}đ</h6>
                                    <small style="font-size:14px; font-weight: 600; margin-left: 5px; background-color: #dc3545; border-radius: 7px ;color: white;
                                    padding: 4px;">
                                        -{{ $pricediscount->percent_price }}%
                                    </small>
                                </div>
                            @else
                                <h4 style="font-weight: 600">{!! App\Helpers\Helper::price($product->price) !!}đ</h4>
                            @endif
                        </span>

                        <!--  -->
                        <div class="p-t-33">
                            {{-- <div class="flex-w flex-r-m p-b-10">
								<div class="size-203 flex-c-m respon6">
									Size
								</div>

								<div class="size-204 respon6-next">
									<div class="rs1-select2 bor8 bg0">
										<select class="js-select2" name="time">
											<option>Choose an option</option>
											<option>Size S</option>
											<option>Size M</option>
											<option>Size L</option>
											<option>Size XL</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div> --}}
                            @if ($product->price !== null)
                                {{-- <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Red</option>
                                                <option>Blue</option>
                                                <option>White</option>
                                                <option>Grey</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        {{-- <input type="hidden" name="product_id" value="{{ $product->id }}" /> --}}
                                        @if ($product->product_quantity == 0)
                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10" style="display:none">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>
                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                    name="num-product" min="1" value="1">
                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                                <button type="button" style="display: none" disabled             
                                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04"
                                                    onclick="return clickAddCart({{ $product->id }},{{ $product->product_quantity }})"
                                                    >
                                                    Thêm sản phẩm 
                                                </button>
                                            @else
                                                <div class="wrap-num-product flex-w m-r-20 m-tb-10" >
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>
                                                    <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                        name="num-product" min="1" value="1">
                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                                <button type="button"          
                                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04"
                                                    onclick="return clickAddCart({{ $product->id }},{{ $product->product_quantity }})"
                                                    >
                                                    Thêm sản phẩm 
                                                </button>
                                            @endif
                                            
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" onclick="btn_addheart({{ $product->id }},'{{ $product->name }}',{{ !empty(session('user_customer_id')) ? session('user_customer_id') : 0  }}); return false;">
                                    <img class="icon-heart1 dis-block trans-04" id="heart1_{{ $product->id }}" style="opacity: 1;" src="/template/images/icons/icon-heart-01.png"
                                    alt="ICON">
                                    @php
                                        $html ='<img class="icon-heart2 dis-block trans-04 ab-t-l" id="heart2_'.$product->id.'"';
                                        if(!empty(session('user_customer_id'))){
                                            foreach ($product->favourite as $key => $item) {
                                                # code...
                                                if ($product->id == $item->product_id && session('user_customer_id') == $item->user_customer_id) {
                                                    # code...
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

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description"
                                role="tab">Thông tin sản phẩm</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh giá ({{ count($comment) }})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <div class="stext-102 cl6">
                                    {!! $product->content !!}
                                </div>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <div class="stext-102 cl6">
                                    {{ $product->description }}
                                </div>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Add review -->
                                        <form class="w-full" style="margin-bottom: 50px;">
                                            {{-- point rating --}}
                                            {{-- <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Your Rating
                                                </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="number" name="rating">
                                                </span>
                                            </div> --}}
                                            <h4>Bình luận</h4>
                                            <p>Thời gian phản hồi 5 phút</p>
                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review" placeholder="Nhập nội dung bình luận"></textarea>
                                                </div>

                                                {{-- <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="name">Name</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                        type="text" name="name">
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="email">Email</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                        type="text" name="email">
                                                </div> --}}
                                            </div>

                                            <button type="button" class="btn btn-primary btn_binhluan" data-id="{{ $product->id }}" >
                                                <i class="fa-solid fa-paper-plane" style="color: white;"></i>
                                                Gửi bình luận
                                            </button>
                                        </form>
                                        <!-- Review -->
                                        @foreach ($comment as $item)
                                            <div class="flex-w flex-t p-b-20 show_comment" style="margin-bottom: 5px">
                                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                    <img class="img_user" src="{{ asset('storage/avatar-khach-hang-2-52544.png') }}" alt="AVATAR">
                                                </div>
                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m " style="margin-bottom: 5px;">
                                                        <span class="mtext-107 cl2 p-r-20" style="font-size: 16px;">
                                                            @php
                                                                preg_match('~\d+~',$item->UserCustomer->user_customer_email,$matches);
                                                                echo str_replace($matches,'***',$item->UserCustomer->user_customer_email)
                                                            @endphp
                                                        </span>
                                                        
                                                        {{-- <span class="fs-18 cl11">
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star"></i>
                                                            <i class="zmdi zmdi-star-half"></i>
                                                        </span> --}}
                                                    </div>
                                                    <div style="color: #6b7280; font-size: 14px; margin-bottom: 5px;">
                                                        Bình luận vào {{ $item->created_at }}
                                                    </div>
                                                    <div class="stext-102 cl6" style="font-size: 16px; color:black;">
                                                        {{ $item->comment_content }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                Hãng: {{ $product->hang->tenhang }}
            </span>

            <span class="stext-107 cl6 p-lr-25">
                {{ $product->menu->name }}: {{ $title }}
            </span>
        </div>
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Sản phẩm tương tự
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($products as $p)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img style="height: 180px;
                                    object-fit: contain;" src="{{ $p->thumb }}" alt="IMG-PRODUCT">
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="/san-pham/{{ $p->id }}-{{ Str::slug($p->name, '-') }}.html"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $p->name }}
                                        </a>

                                        <span class="stext-105 cl3">
                                            @if (!empty($p->tbl_price_dicount) && date("Y/m/d") !== str_replace('-','/',$p->tbl_price_dicount->end_at))
                                                @php
                                                $price = $p->price;
                                                $percent = $p->tbl_price_dicount->percent_price/100;
                                                $discount = $price * $percent;
                                                $total = $price - $discount;
                                                @endphp
                                            <div style="font-weight: 600; margin-left: 5px;">{{ number_format($total)}}đ</div>
                                            <div style="display: flex; align-items: center;">
                                                <div style="font-weight: 600; margin-left: 5px; text-decoration-line: line-through; color: #9ca3af;">{{ number_format($p->price) }}đ</div>
                                                <div style="margin-left: 5px; background-color: #dc3545;border-radius: 7px">
                                                    <small style="color: white; font-weight: 600;
                                                                padding: 5px 5px 0px 6px;">-{{ $p->tbl_price_dicount->percent_price }}%</small>
                                                </div>
                                            </div>
                                            @else
                                                <div style="font-weight: 600; margin-left: 5px;"> {!! App\Helpers\Helper::price($p->price) !!}đ</div>
                                            @endif
                                        </span>
                                    </div>

                                    <div class=" flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" onclick="btn_addheart({{ $product->id }},'{{ $product->name }}',{{ !empty(session('user_customer_id')) ? session('user_customer_id') : 0  }}); return false;">
                                            <img class="icon-heart1 dis-block trans-04" id="heart1_{{ $product->id }}" style="opacity: 1;" src="/template/images/icons/icon-heart-01.png"
                                            alt="ICON">
                                            @php
                                                $html ='<img class="icon-heart2 dis-block trans-04 ab-t-l" id="heart2_'.$product->id.'"';
                                                if(!empty(session('user_customer_id'))){
                                                    foreach ($product->favourite as $key => $item) {
                                                        # code...
                                                        if ($product->id == $item->product_id && session('user_customer_id') == $item->user_customer_id) {
                                                            # code...
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
            </div>
        </div>
    </section>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="images/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-01.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-02.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-03.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                Lightweight Jacket
                            </h4>

                            <span class="mtext-106 cl2">
                                $58.79
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare
                                feugiat.
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Size S</option>
                                                <option>Size M</option>
                                                <option>Size L</option>
                                                <option>Size XL</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Red</option>
                                                <option>Blue</option>
                                                <option>White</option>
                                                <option>Grey</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to cart
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <!--  -->
                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" onclick="btn_addheart({{ $product->id }},'{{ $product->name }}',{{ !empty(session('user_customer_id')) ? session('user_customer_id') : 0  }}); return false;">
                                        <img class="icon-heart1 dis-block trans-04" id="heart1_{{ $product->id }}" style="opacity: 1;" src="/template/images/icons/icon-heart-01.png"
                                        alt="ICON">
                                        @php
                                            $html ='<img class="icon-heart2 dis-block trans-04 ab-t-l" id="heart2_'.$product->id.'"';
                                            if(!empty(session('user_customer_id'))){
                                                foreach ($product->favourite as $key => $item) {
                                                    # code...
                                                    if ($product->id == $item->product_id && session('user_customer_id') == $item->user_customer_id) {
                                                        # code...
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

                                {{-- <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.btn_binhluan').on('click',function() {
            var comment = $('#review').val();
            var id = $(this).data('id');
            $.ajax({
                url:"{{ route('commentProduct') }}",
                type:"POST",
                data:{
                    _token:"{{ csrf_token() }}",
                    id:id,
                    comment:comment,
                },
                success:function(response){
                    if(response){
                        window.location.reload();
                    }else{
                        window.location.replace('http://shopbanhang.com/dang-nhap');
                    }
                }
            });
        });
        
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
