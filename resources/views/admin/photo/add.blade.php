@extends("admin.layout")
@section("title", "新增圖檔")
@section("content")
<div class="mx-3">
    <form method="post" action="/admin/photo/insert" enctype="multipart/form-data">
        <input type="hidden" name="productId" value="{{ $productId }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2 text-right">圖檔</div>
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