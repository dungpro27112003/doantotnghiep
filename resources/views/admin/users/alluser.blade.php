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
                <th>Tên tài khoản</th>
                <th>Email tài khoản</th>
                <th>Admin</th>
                <th>Nhân viên</th>
                <th>Khách hàng</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usercustomer as $key => $item)
            <form action="{{ route('alluser.store') }}" method="post">
                @csrf
                <tr>
                    <td>{{$item->user_customer_name}}</td>
                    <td>{{$item->user_customer_email}}</td>
                    <input type="hidden" name="email" value="{{$item->user_customer_email}}">
                    <td>
                        <input type="checkbox" name="chk_admin" id="" {{ $item->has_role(1)?'checked':false }}>
                    </td>
                    <td>
                        <input type="checkbox" name="chk_nhanvien" id="" {{ $item->has_role(2)?'checked':false }}>
                    </td>
                    <td>
                        <input type="checkbox" name="chk_customer" id="" {{ $item->has_role(3)?'checked':false }}>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Thay đổi</button>
                    </td>
                    {{-- <td>
                        <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{$item->order_id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="btn btn-danger btn-sm btn_destroy" data-id="{{ $item->order_id }}" ><i class="fa-solid fa-xmark"></i></a>
                    </td> --}}
                </tr>

            </form>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $usercustomer->links() !!}

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

