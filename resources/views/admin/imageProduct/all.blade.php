@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($image as $key => $item)
            <tr>
                <td>
                    <img style="width: 100px;
    height: 100px;
    object-fit: contain;" src="{{ $item->image_link }}" alt="">
                </td>
                <td>{{ $item->tbl_product->name }}</td>
                <td>&nbsp;</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="
                    {{ route('image.edit',$item->image_id) }}
                    "><i class="fa-solid fa-pen-to-square"></i></a>
                    {{-- <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$hang->id}},'/admin/hang/destroy')"><i class="fa-solid fa-xmark"></i></a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $image->links() !!}
@endsection


