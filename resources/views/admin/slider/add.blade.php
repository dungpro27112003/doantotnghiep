@extends('admin.main')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <label for="menu">Tiêu đề</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" >
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh slide</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show"></div>
                <input type="hidden" name="thumb" id="thumb"/>
            </div>
            <div class="form-group">
                <label for="menu">Sản phẩm</label>
                <select class="form-control" name="slc_product" id="">
                    <option value="">--- Tất cả sản phẩm ---</option>
                    @foreach ($product as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
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
            <button type="submit" class="btn btn-primary">Thêm slider</button>
        </div>
        @csrf
    </form>
@endsection


