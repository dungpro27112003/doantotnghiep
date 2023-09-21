@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tiêu đề</th>
                <th>Link</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $key => $slider)
            <tr>
                <td>{{$slider->id}}</td>
                <td>{{$slider->name}}</td>
                <td>{{$slider->url}}</td>
                <td>
                    <a href="{{$slider->thumb}}" target="_blank">
                        <img src="{{$slider->thumb}}" height="40px"/>
                    </a>
                </td>
                <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                <td>{{$slider->updated_at}}</td>
                <td>&nbsp;</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{$slider->id}}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$slider->id}},'/admin/sliders/destroy')"><i class="fa-solid fa-xmark"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $sliders->links() !!}
@endsection


