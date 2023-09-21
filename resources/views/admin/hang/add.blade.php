@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên hãng</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên hãng">
            </div>

            {{-- <div class="form-group">
                <label>Danh mục</label>
                <select name="parent_id" class="form-control">
                    <option value="0">Danh mục cha</option>
                    @foreach ($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                    @endforeach
                </select>
            </div> --}}

            
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
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
