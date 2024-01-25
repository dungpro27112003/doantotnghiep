@extends('layout.home')

@section('content')
<br>
<br>

    <div class="bg0 m-t-23 p-b-140 p-t-40">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <h1>{{ $title }}</h1>
                </div>

                {{-- <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>

                </div> --}}

                <!-- Search product -->

                {{-- <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <form action="/danh-muc/{{ $menus->id }}-{slug}.html" method="GET">
                        <div class="bor8 dis-flex p-l-15">
                            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                            <form action="/danh-muc/{{ $menus->id }}-{{ Str::slug($menus->name)}}.html" method="GET">
                                <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search"
                                    id="search" placeholder="Search">
                            </form>
                        </div>
                    </form>
                </div> --}}

                <!-- Filter -->
                {{-- <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Sort By
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04">
                                        Default
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}"
                                        class="filter-link stext-106 trans-04">
                                        Price: Low to High
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}"
                                        class="filter-link stext-106 trans-04">
                                        Price: High to Low
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Price
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="{{ request()->url() }}"
                                        class="filter-link stext-106 trans-04 filter-link-active">
                                        All
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => '0-5000000']) }}"
                                        class="filter-link stext-106 trans-04">
                                        0 - 5.000.000
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => '5000000-10000000']) }}"
                                        class="filter-link stext-106 trans-04">
                                        5.000.000 - 10.000.000
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="{{ request()->fullUrlWithQuery(['price' => '10000000-up']) }}"
                                        class="filter-link stext-106 trans-04">
                                        10.000.000 trở lên
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div> --}}
            </div>

            @include('products.list')
            {{-- <div style="
                display: flex;
                justify-content: center;
            ">
                {!! $products->links() !!}
            </div> --}}

        </div>
    </div>
@endsection
