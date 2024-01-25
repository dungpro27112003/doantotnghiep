@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="{{ route('image.update',$image->image_id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Hình ảnh</label>
                <input type="file" name="image_link"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{$image->image_link}}" target="_blank">
                        <img src="{{$image->image_link}}" width="100px"/>
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{$image->image_link}}" id="thumb"/>
            </div>
            <div class="form-group">
                <label for="menu">Sản phẩm</label>
                <select class="form-control" name="slc_product" id="">
                    <option value="">--- Tất cả sản phẩm ---</option>
                    @foreach ($product as $item)
                        <option value="{{ $item->id }}" {{ $item->id==$image->product_id?'selected':false }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
    
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
