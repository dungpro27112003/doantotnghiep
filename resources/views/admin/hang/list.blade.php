@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên hãng</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hangs as $key => $hang)
            <tr>
                <td>{{$hang->id}}</td>
                <td>{{$hang->tenhang}}</td>
                <td>{{$hang->updated_at}}</td>
                <td>&nbsp;</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="
                    {{-- {{route(showedit)}} --}}
                    /admin/hang/edit/{{$hang->id}}
                    "><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$hang->id}},'/admin/hang/destroy')"><i class="fa-solid fa-xmark"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $hangs->links() !!}
@endsection


