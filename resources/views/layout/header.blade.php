<header>
    @php $menusHtml = \App\Helpers\Helper::menus($menus); @endphp
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/07/banner/Lap-1200-44-1200x44-1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/08/banner/BIG1200-44-1200x44.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/09/banner/mua1duoc5-1200-44-1200x44.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="/template/images/logomauden.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        {!! $menusHtml !!}
                        {{-- <li class="active-menu">
                            <a href="index.html">Home</a>
                            <ul class="sub-menu">
                                <li><a href="index.html">Homepage 1</a></li>
                                <li><a href="home-02.html">Homepage 2</a></li>
                                <li><a href="home-03.html">Homepage 3</a></li>
                            </ul>
                        </li> --}}


                    </ul>
                </div>

                <!-- Icon header -->
                <!-- flex-direction: column-reverse; -->
                <div class="wrap-icon-header flex-w " style="display: flex;
                ">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                    {{-- <a href=""> --}}
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{!is_null(Session::get('carts')) ? count(Session::get('carts')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    {{-- </a> --}}

                    {{-- <a href="#"
                        class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                        data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a> --}}

                </div>
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="header-action_text">
                        @if (session('user_customer_id'))
                        <div class="img_customer">
                            <img src="{{ asset('storage/avatar-khach-hang-2-52544.png') }}" alt="" style="box-shadow: var(--g,0 0 #0000),var(--h,0 0 #0000),var(--i); margin-left:10px; cursor: pointer; border-radius: 50%; width: 50px; height: 50px ">
                            <div class="container_customer">
                                <ul>
                                    <li>
                                        <a class="option_customer_a_li slc_manager_user" href="{{ route('managerUser',[1]) }}">Quản lý tài khoản</a>
                                    </li>
                                    <li>
                                        <a class="option_customer_a_li slc_history_order" href="{{ route('managerUser',[2]) }}">Lịch sử đơn hàng</a>

                                    </li>
                                    <li>
                                        <a class="option_customer_a_li slc_likes_product" href="{{ route('managerUser',[3]) }}">Sản phẩm yêu thích</a>
                                    </li>
                                    <li>
                                        <a class="option_customer_a_li header-action__link" href="{{ route('logout') }}" rel="nofollow" id="site-account-handle" aria-label="Tài khoản" title="Tài khoản" style="display: flex;">
                                            Đăng xuất
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @else
                        <a class="header-action__link" href="{{ route('login') }}" rel="nofollow" id="site-account-handle" aria-label="Tài khoản" title="Tài khoản" style="display: flex;">
                            Đăng nhập
                        </a>
                        @endif

                        {{-- <span class="box-triangle">
                            <svg viewBox="0 0 20 9" role="presentation">
                                <path d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                            </svg>
                        </span> --}}

                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="/template/images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>


        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <div class="content-topbar flex-sb-m h-full container">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="3000">
                            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/07/banner/Lap-1200-44-1200x44-1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/08/banner/BIG1200-44-1200x44.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/09/banner/mua1duoc5-1200-44-1200x44.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </ul>

        <ul class="main-menu-m">
            <li class="active-menu"><a href="/">Trang chủ</a></li>

            {!! \App\Helpers\Helper::menus($menus) !!}

        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form action="{{ route('searchProduct') }}" method="GET" class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04 btn_search">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3 input_key_search" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
@section('js')
{{-- <script>
    //     $(document).ready(function() {
    //         $('.slc_manager_user').on('click',function(e) {
    //             e.preventDefault();
    //             $.ajax({
    //                 url:"{{ route('managerUser') }}",
// type:"GET",
// data:{
// },
// success:function(response){
// window.location.href = "{{ route('managerUser') }}";
// }
// })
// })
// })
// </script> --}}
@endsection