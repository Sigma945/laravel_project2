@extends("admin.layout")
@section("title", "新增商店")
@section("content")
<script>
    function doCheck(shopName)
    {
        $.ajax({
            url: "/admin/shop/check",
            type: "post",
            data: {
                shopName: shopName,
                _token: "{{ csrf_token() }}",
            },
            success: function(msg){
                if(msg == "exist"){
                    Swal.fire(shopName + "已存在");
                }
            }
        });
    }
</script>
<div class="mx-3">
    <form method="post" action="/admin/shop/insert">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-2 text-right">商店名稱</div>
            <div class="col-4">
                <input type="text" class="form-control" name="shopName" required onkeyup="doCheck(this.value)">
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