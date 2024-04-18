@extends("admin.layout")
@section("title", "Banner管理")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="/admin/banner/add" class="btn btn-primary">新增</a>&nbsp;&nbsp;
                <a href="javascript:deleteAll(list)" class="btn btn-danger">刪除</a>
            </div>
        </div>

        <form method="post" action="/admin/banner/delete" id="list" name="list">
            {{ csrf_field() }}
            <table class="table table-bordered table-hover">
                <tr class="table-secondary">
                    <th class="text-center"><input type="checkbox" id="all" class="form-check-input"></th>
                    <th class="text-center">AP</th>
                    <th class="text-center">Banner</th>
                    <th class="text-center">修改</th>
                </tr>
                @foreach($list as $data)
                <tr>
                    <td class="text-center">
                    <input type="checkbox" class="form-check-input chk" name="id[]" value="{{ $data->id }}">
                    </td>
                    <td class="text-center">{{ $data->ap_name }}</td> 
                    <td class="text-center">
                        <img src="/images/banner/{{ $data->photo }}" width="200">
                    </td>
                    <td class="text-center"><a href="/admin/banner/edit/{{ $data->id }}" class="btn btn-success">修改</td>
                </tr>
                @endforeach
            </table>
        </form>
    </div>
</div>
@endsection