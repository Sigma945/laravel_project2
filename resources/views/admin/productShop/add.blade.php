@extends("admin.layout")
@section("title", "新增產品商店")
@section("content")
<div class="mx-3">
    <form method="post" action="/admin/productShop/insert">
        <input type="hidden" name="productId" value="{{ $productId }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2 text-right">商店</div>
            <div class="col-4">
                <select name="shopId" class="form-control">
                    <option value="">請選擇商店</option>
                    @foreach($list as $data)
                    <option value="{{ $data->id }}">{{ $data->shopName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-2 text-right">網址</div>
            <div class="col-10">
                <input type="text" class="form-control" name="url">
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