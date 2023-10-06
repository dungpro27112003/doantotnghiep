@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Ngày đặt hàng</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $key => $customer)
            <tr>
                <td>{{$customer->id}}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->created_at}}</td>
                <td>&nbsp;</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/customers/view/{{$customer->id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$customer->id}},'/admin/customers/destroy')"><i class="fa-solid fa-xmark"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $customers->links() !!}

    </div>
@endsection


