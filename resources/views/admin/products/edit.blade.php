@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    @if (!empty(session('errror')))
        <div class="alert alert-danger">{{ session('errror') }}</div>
    @endif
    @if (!empty(session('success')))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên sản phẩm</label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="menu">Giá gốc</label>
                        <input type="number" name="price" value="{{$product->price}}" class="form-control" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="menu_id" class="form-control">
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" {{$product->menu_id == $menu->id ? 'selected':''}}>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Hãng</label>
                <select name="hang_id" class="form-control">
                    @foreach ($hang as $h)
                        <option value="{{ $h->id }}" {{$product->hang_id == $h->id ? 'selected':''}}>{{ $h->tenhang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="number" name="quantity" value="{{$product->product_quantity}}" class="form-control" >
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="content" id="content" class="form-control">{{$product->content}}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh sản phẩm</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{$product->thumb}}" target="_blank">
                        <img src="{{$product->thumb}}" width="100px"/>
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{$product->thumb}}" id="thumb"/>
            </div>

            <div class="form-group">
                <label>kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{$product->active==1 ?'checked':''}}
                    >
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                    {{$product->active== 0 ?'checked':''}}
                    >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
