@extends('admin.main')

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên coupon</th>
                <th>Code</th>
                <th>Số lượng</th>
                <th>Gía tiền giảm</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($coupon as $key => $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->coupon_name}}</td>
                <td>{{$item->coupon_code}}</td>
                <td>{{$item->coupon_quantity}}</td>
                <td>{{$item->coupon_discount}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('coupon.edit',$item->coupon_id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('coupon.destroy',$item->coupon_id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm " onclick="return confirm('Bạn có thực sự muốn xóa?')"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $coupon->links() !!}
@endsection


