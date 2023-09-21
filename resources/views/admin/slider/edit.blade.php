
@extends('admin.main')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề</label>
                        <input type="text" name="name" value="{{$sliders->name}}" class="form-control" >
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đường dẫn</label>
                        <input type="text" name="url" value="{{$sliders->url}}" class="form-control" >
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh sản phẩm</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{$sliders->thumb}}">
                        <img src="{{$sliders->thumb}}" width="100px"/>
                    </a>
                </div>
                <input type="hidden" name="thumb" id="thumb" value="{{$sliders->thumb}}"/>
            </div>
            
            <div class="form-group">
                <label for="menu">Sắp xếp</label>
                <input type="number" name="sort_by" value="{{$sliders->sort_by}}" class="form-control" >
            </div>

            <div class="form-group">
                <label>kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{$sliders->active == 1 ? 'checked' : ''}}
                    >
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{$sliders->active == 0 ? 'checked' : ''}}
                    >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật slider</button>
        </div>
        @csrf
    </form>
@endsection



