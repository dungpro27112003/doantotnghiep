@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên sản phẩm</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Nhập tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="menu">Giá gốc</label>
                        <input type="number" name="price" value="{{old('price')}}" class="form-control" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="menu_id" class="form-control">
                            @foreach ($menus as $mn)
                                <option value="{{ $mn->id }}">{{ $mn->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Giá giảm</label>
                        <input type="number" value="{{old('price_sale')}}" name="price_sale" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Danh mục</label>
                <select name="hang_id" class="form-control">
                    @foreach ($hang as $h)
                        <option value="{{ $h->id }}">{{ $h->tenhang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{old('description')}}</textarea>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea name="content" id="content" class="form-control">{{old('content')}}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh sản phẩm</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show"></div>
                <input type="hidden" name="thumb" id="thumb"/>
            </div>

            <div class="form-group">
                <label>kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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
