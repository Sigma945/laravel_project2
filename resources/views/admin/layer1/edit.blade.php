@extends("admin.layout")
@section("title", "修改類別")
@section("content")
<div class="mx-3">
    <form method="post" action="/admin/layer1/update">
        <input type="hidden" name="id" value="{{ $layer1->id }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2 text-right">類別名稱</div>
            <div class="col-4">
                <input type="text" class="form-control" name="layer1_name" required value="{{ $layer1->layer1_name }}">
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