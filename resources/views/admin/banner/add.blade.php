@extends("admin.layout")
@section("title", "新增Banner")
@section("content")
<div class="mx-3">
    <form method="post" action="/admin/banner/insert" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2 text-right">AP</div>
            <div class="col-4">
                <select name="id" class="form-control" required>
                    <option value="">請選擇AP</option>
                    @foreach($list as $data)
                    <option value="{{ $data->id }}">{{ $data->ap_name }}</option>
                    @endforeach
                </select>            
            </div>

        </div>
        <div class="row">
            <div class="col-2 text-right">Bannerphp</div>
            <div class="col-4">
                <input type="file" class="form-control" name="photo" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2"></div>
            <div class="col-2">
                <input type="submit" class="btn btn-primary" value=" 確 定 ">
            </div>
            <div class="col-2 text-right">
                <button type="button" class="btn btn-warning" onclick="javascript:history.back()">放棄</button> 
            </div>
        </div>
    </form>
</div>
@endsection