@extends("admin.layout")
@section("title", "修改規格")
@section("content")
<div class="mx-3">
    <form method="post" action="/admin/spec/update">
        <input type="hidden" name="productId" value="{{ $productId }}">
        <input type="hidden" name="id" value="{{ $id }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2 text-right">規格名稱</div>
            <div class="col-4">
                <input type="text" class="form-control" name="title" required value="{{ $spec->title }}">
            </div>
        </div>
        <div class="row">
            <div class="col-2 text-right">規格內容</div>
            <div class="col-4">
                <input type="text" class="form-control" name="content" required value="{{ $spec->content }}">
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