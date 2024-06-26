@extends("admin.layout")
@section("title", "修改商店")
@section("content")
<div class="mx-3">
    <form method="post" action="/admin/shop/update">
        <input type="hidden" name="id" value="{{ $shop->id }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2 text-right">商店名稱</div>
            <div class="col-4">
                <input type="text" class="form-control" name="shopName" required value="{{ $shop->shopName }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2"></div>
            <div class="col-2">
                <input type="submit" class="btn btn-primary" value=" 確 定 ">
            </div>
        </div>
    </form>
</div>
@endsection