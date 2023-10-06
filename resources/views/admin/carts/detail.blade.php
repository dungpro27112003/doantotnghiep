@extends('admin.main')

@section('content')
    <div class="customer">
        <ul>
            <li>Tên khách hàng:<strong>{{ $customer->name }}</strong></li>
            <li>Số điện thoại:<strong>{{ $customer->phone }}</strong></li>
            <li>Địa chỉ:<strong>{{ $customer->address }}</strong></li>
            <li>Email:<strong>{{ $customer->email }}</strong></li>
            <li>Ghi chú:<strong>{{ $customer->content }}</strong></li>
        </ul>
    </div>
    <div class="carts">
        @php
            $total = 0;
        @endphp
        <table class="table">
            <tbody>
                <tr class="table_head">
                    <th class="column-1">Product</th>
                    <th class="column-2">Tên</th>
                    <th class="column-3">Price</th>
                    <th class="column-4">Quantity</th>
                    <th class="column-5">Total</th>
                </tr>

                @foreach ($carts as $key => $cart)
                    @php
                        $price= $cart->price * $cart->pty;
                        $total += $price;
                    @endphp

                    <tr class="table_row">
                        <td class="column-1">
                            <div class="how-itemcart1">
                                <img src="{{$cart->product->thumb}}" alt="IMG" width="100">
                            </div>
                        </td>
                        <td class="column-2">{{ $cart->product->name }}</td>
                        <td class="column-3">{{ number_format($cart->price, 0, '.') }}đ</td>
                        <td class="column-4">
                           {{$cart->pty}}
                        </td>
                        <td class="column-5">{{ number_format($price, 0, '.') }}đ</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">Tổng tiền</td>
                    <td colspan="3">{{ number_format($total, 0, '.') }}đ</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
