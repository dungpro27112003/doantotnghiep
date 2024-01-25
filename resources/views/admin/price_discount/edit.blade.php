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
    <form action="{{ route('discount.update',$pricediscount->id) }}" method="post">
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Sản phẩm</label>
                <select class="form-control" name="slc_product" class="slc_product" id="">
                    <option value="">--- Tất cả sản phẩm ---</option>
                    @foreach ($product as $item)
                        <option value="{{ $item->id }}" {{ $pricediscount->product_id==$item->id?"selected":false }} >{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="menu">Phần trăm số tiền giảm</label>
                <input type="text" name="percent_price" class="form-control" value="{{ $pricediscount->percent_price }}" >
            </div>
            <div class="form-group">
                <label for="menu">Ngày kết thúc khuyến mãi</label>
                <input type="date" name="end_date" class="form-control" value="{{ Str::replaceArray('/', '-', $pricediscount->end_at) }}">
                
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
        // $(function() {
        //     $('#datepicker').datepicker();
        // })
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
