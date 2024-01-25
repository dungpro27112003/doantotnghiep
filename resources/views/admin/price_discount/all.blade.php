@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá gốc</th>
                <th>Giá khuyến mãi</th>
                <th>Ngày kết thúc khuyến mãi</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pricediscount as $key => $item)
            <tr>
                <td>{{$item->product->name}}</td>
                <td>{{$item->product->product_quantity}}</td>
                <td>{{$item->product->price}}</td>
                @php
                    $total = 0;
                    $price = $item->product->price;
                    $percent = $item->percent_price/100;
                    $pricediscount = $price * $percent;
                    $total += $price - $pricediscount;

                @endphp
                <td>{{$total }}</td>
                <td>{{ $item->end_at }}</td>
                <td>{!! \App\Helpers\Helper::active($item->product->active) !!}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{route('discount.edit',$item->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{route('discount.destroy',$item->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm " onclick="return confirm('Bạn có thực sự muốn xóa?')"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="card-footer clearfix">
        {!! $products->links() !!}

    </div> --}}
@endsection


