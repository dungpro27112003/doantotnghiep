@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <form action="{{ route('coupon.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Coupon Name</label>
                <input type="text" name="coupon_name" class="form-control" placeholder="Nhập tên coupon">
            </div>
            <div class="form-group">
                <label for="menu">Coupon Code</label>
                <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code">
            </div>
            <div class="form-group">
                <label for="menu">Coupon Quantity</label>
                <input type="number" min="1" name="coupon_quantity" class="form-control" placeholder="Số lượng">
            </div>
            <div class="form-group">
                <label for="menu">Coupon Discount</label>
                <input type="text" name="coupon_discount" class="form-control" placeholder="Gía giảm">
            </div>

        

            
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm</button>
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
