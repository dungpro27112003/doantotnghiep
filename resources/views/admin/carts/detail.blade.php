@extends('admin.main')

@section('content')
    <div class="customer">
        <ul>
            <li>Tên khách hàng:<strong>{{ $order->order_name }}</strong></li>
            <li>Số điện thoại:<strong>{{ $order->order_phone }}</strong></li>
            <li>Địa chỉ:<strong>{{ $order->order_address }}</strong></li>
            <li>Email:<strong>{{ $order->order_email }}</strong></li>
            {{-- <li>Ghi chú:<strong>{{ $order->content }}</strong></li> --}}
        </ul>
    </div>
    <div class="carts">
        <table class="table">
            <tbody>
                <tr class="table_head">
                    <th class="column-1"></th>
                    <th class="column-2">Tên sản phẩm</th>
                    <th class="column-3">Giá sản phẩm</th>
                    <th class="column-3">Khuyến mãi</th>
                    <th class="column-4">Số lượng</th>
                    <th class="column-5">Mã giảm giá</th>
                    <th class="column-6">Tổng tiền</th>
                </tr>

                @php
                    $total = 0;
                @endphp
                @foreach ($carts as $key => $item)
                    @php
                        // $price= $item->price * $item->pty;
                        $total += $item->price;
                    @endphp
                    <tr class="table_row">
                        <td class="column-1">
                            <div class="how-itemcart1">
                                <img src="{{$item->product->thumb}}" alt="IMG" width="100">
                            </div>
                        </td>
                        <td class="column-2">{{ $item->product->name }}</td>
                        <td class="column-3">{{ number_format($item->product->price, 0, '.') }}đ</td>
                        @if (!empty($item->product->tbl_price_dicount))
                            <td class="column-4">-{{$item->product->tbl_price_dicount->percent_price}}%</td>
                        @else
                            <td class="column-4">none</td>
                        @endif
                        <td class="column-5">
                            {{$item->pty}}
                        </td>
                        <td class="column-6">{{ $item->coupon_code!=null?$item->coupon_code:"none" }}</td>
                        <td class="column-7">{{ number_format($item->price, 0, '.') }}đ</td>
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
