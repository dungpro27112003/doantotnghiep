@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Hãng</th>
                <th>Số lượng</th>
                <th>Giá gốc</th>
                <th>Update</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>
                    @if ($product->menu)
                        {{$product->menu->name}}
                    @else
                        Không có danh nằm trong danh mục
                    @endif
                </td>
                <td>
                    @if ($product->hang)
                        {{$product->hang->tenhang}}
                    @else
                        Không có danh nằm trong danh mục
                    @endif
                </td>
                <td>{{$product->product_quantity}}</td>
                <td>{{$product->price}}</td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td>{{$product->updated_at}}</td>
                <td>&nbsp;</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{$product->id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$product->id}},'/admin/products/destroy'); return false;"><i class="fa-solid fa-xmark"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $products->links() !!}

    </div>
@endsection


