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
                <th style="width: 50px">STT</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt hàng</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($order as $key => $item)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$item->order_name}}</td>
                <td>{{$item->order_phone}}</td>
                <td>{{$item->order_email}}</td>
                <td>{{$item->order_address}}</td>
                <td>{{$item->created_at}}</td>
                {{-- <td>&nbsp;</td> --}}
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{$item->order_id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger btn-sm btn_destroy" data-id="{{ $item->order_id }}" ><i class="fa-solid fa-xmark"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $order->links() !!}

    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.btn_destroy').on('click', function(e) {
                var id = $(this).data('id');
                if(confirm('Bạn có muốn xóa ?') == true){
                    $.ajax({
                        url:"{{ route('deleteCustomer') }}",
                        type:"POST",
                        data:{
                            _token:"{{ csrf_token() }}",
                            id:id,
                        },
                        success:function() {
                            window.location.reload();
                        }
                    })
                }
            })
        })
    </script>
@endsection

