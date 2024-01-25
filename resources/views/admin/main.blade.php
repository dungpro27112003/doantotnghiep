<html lang="en" style="height: auto;">

<head>
    @include('admin.head')
</head>

<body class="sidebar-mini sidebar-closed sidebar-collapse" style="height: auto;">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('indexAdmin') }}" class="nav-link">Trang chủ Admin</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    @if (!empty(session('user')))
                        <a href="{{ route('logoutAdmin') }}" class="nav-link">Đăng xuất</a>
                    @endif
                </li>
            </ul>

            <!-- Right navbar links -->
            {{-- <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul> --}}
        </nav>
        <!-- /.navbar -->

        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 2171.31px;">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @include('admin.alert')
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-primary mt-3">
                                <div class="card-header">
                                    <h3 class="card-title"> {{ $title }}</h3>
                                </div>
                                
                                @yield('content')
                                

                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0
            </div>
            <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark" style="display: none;">
            <!-- Control sidebar content goes here -->
            <div class="p-3 control-sidebar-content" style="">
                <h5>Customize AdminLTE</h5>
                <hr class="mb-2">
                <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Dark Mode</span>
                </div>
                <h6>Header Options</h6>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Dropdown Legacy
                        Offset</span></div>
                <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>No border</span>
                </div>
                <h6>Sidebar Options</h6>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Collapsed</span>
                </div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div>
                <div class="mb-1"><input type="checkbox" value="1" checked="checked"
                        class="mr-1"><span>Sidebar Mini</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Mini
                        MD</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Mini
                        XS</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Flat Style</span>
                </div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Legacy
                        Style</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Compact</span>
                </div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Child
                        Indent</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Child Hide on
                        Collapse</span></div>
                <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Disable Hover/Focus
                        Auto-Expand</span></div>
                <h6>Footer Options</h6>
                <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div>
                <h6>Small Text Options</h6>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Body</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Navbar</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Brand</span></div>
                <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Nav</span>
                </div>
                <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Footer</span></div>
                <h6>Navbar Variants</h6>
                <div class="d-flex"><select class="custom-select mb-3 text-light border-0 bg-white">
                        <option class="bg-primary">Primary</option>
                        <option class="bg-secondary">Secondary</option>
                        <option class="bg-info">Info</option>
                        <option class="bg-success">Success</option>
                        <option class="bg-danger">Danger</option>
                        <option class="bg-indigo">Indigo</option>
                        <option class="bg-purple">Purple</option>
                        <option class="bg-pink">Pink</option>
                        <option class="bg-navy">Navy</option>
                        <option class="bg-lightblue">Lightblue</option>
                        <option class="bg-teal">Teal</option>
                        <option class="bg-cyan">Cyan</option>
                        <option class="bg-dark">Dark</option>
                        <option class="bg-gray-dark">Gray dark</option>
                        <option class="bg-gray">Gray</option>
                        <option class="bg-light">Light</option>
                        <option class="bg-warning">Warning</option>
                        <option class="bg-white">White</option>
                        <option class="bg-orange">Orange</option>
                    </select></div>
                <h6>Accent Color Variants</h6>
                <div class="d-flex"></div><select class="custom-select mb-3 border-0">
                    <option>None Selected</option>
                    <option class="bg-primary">Primary</option>
                    <option class="bg-warning">Warning</option>
                    <option class="bg-info">Info</option>
                    <option class="bg-danger">Danger</option>
                    <option class="bg-success">Success</option>
                    <option class="bg-indigo">Indigo</option>
                    <option class="bg-lightblue">Lightblue</option>
                    <option class="bg-navy">Navy</option>
                    <option class="bg-purple">Purple</option>
                    <option class="bg-fuchsia">Fuchsia</option>
                    <option class="bg-pink">Pink</option>
                    <option class="bg-maroon">Maroon</option>
                    <option class="bg-orange">Orange</option>
                    <option class="bg-lime">Lime</option>
                    <option class="bg-teal">Teal</option>
                    <option class="bg-olive">Olive</option>
                </select>
                <h6>Dark Sidebar Variants</h6>
                <div class="d-flex"></div><select class="custom-select mb-3 text-light border-0 bg-primary">
                    <option>None Selected</option>
                    <option class="bg-primary">Primary</option>
                    <option class="bg-warning">Warning</option>
                    <option class="bg-info">Info</option>
                    <option class="bg-danger">Danger</option>
                    <option class="bg-success">Success</option>
                    <option class="bg-indigo">Indigo</option>
                    <option class="bg-lightblue">Lightblue</option>
                    <option class="bg-navy">Navy</option>
                    <option class="bg-purple">Purple</option>
                    <option class="bg-fuchsia">Fuchsia</option>
                    <option class="bg-pink">Pink</option>
                    <option class="bg-maroon">Maroon</option>
                    <option class="bg-orange">Orange</option>
                    <option class="bg-lime">Lime</option>
                    <option class="bg-teal">Teal</option>
                    <option class="bg-olive">Olive</option>
                </select>
                <h6>Light Sidebar Variants</h6>
                <div class="d-flex"></div><select class="custom-select mb-3 border-0">
                    <option>None Selected</option>
                    <option class="bg-primary">Primary</option>
                    <option class="bg-warning">Warning</option>
                    <option class="bg-info">Info</option>
                    <option class="bg-danger">Danger</option>
                    <option class="bg-success">Success</option>
                    <option class="bg-indigo">Indigo</option>
                    <option class="bg-lightblue">Lightblue</option>
                    <option class="bg-navy">Navy</option>
                    <option class="bg-purple">Purple</option>
                    <option class="bg-fuchsia">Fuchsia</option>
                    <option class="bg-pink">Pink</option>
                    <option class="bg-maroon">Maroon</option>
                    <option class="bg-orange">Orange</option>
                    <option class="bg-lime">Lime</option>
                    <option class="bg-teal">Teal</option>
                    <option class="bg-olive">Olive</option>
                </select>
                <h6>Brand Logo Variants</h6>
                <div class="d-flex"></div><select class="custom-select mb-3 border-0">
                    <option>None Selected</option>
                    <option class="bg-primary">Primary</option>
                    <option class="bg-secondary">Secondary</option>
                    <option class="bg-info">Info</option>
                    <option class="bg-success">Success</option>
                    <option class="bg-danger">Danger</option>
                    <option class="bg-indigo">Indigo</option>
                    <option class="bg-purple">Purple</option>
                    <option class="bg-pink">Pink</option>
                    <option class="bg-navy">Navy</option>
                    <option class="bg-lightblue">Lightblue</option>
                    <option class="bg-teal">Teal</option>
                    <option class="bg-cyan">Cyan</option>
                    <option class="bg-dark">Dark</option>
                    <option class="bg-gray-dark">Gray dark</option>
                    <option class="bg-gray">Gray</option>
                    <option class="bg-light">Light</option>
                    <option class="bg-warning">Warning</option>
                    <option class="bg-white">White</option>
                    <option class="bg-orange">Orange</option><a href="#">clear</a>
                </select>
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <div id="sidebar-overlay"></div>
    </div>
    <!-- ./wrapper -->
    @include('admin.footer')
    <script>
        $('.btn_delete').on('click',function(event){
        event.preventDefault();
        var id = $(this).data('id');
        if(confirm('Bạn có muốn xoá sản phẩm này vĩnh viễn không?')){
            $.ajax({
                type:'DELETE',
                datatype:'JSON',
                data:{
                    _token:"{{ csrf_token() }}",
                    id:id,
                },
                url:"{{ route('deleteMenu') }}",
                success:function(result){
                    if(result.error ===false){
                        location.reload();
                    }else{
                        alert('Đã xảy ra vấn đề lỗi xin vui lòng thử lại');
                    }
                }
            })
        }
    })
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>  
    @yield('js')
</body>

</html>
