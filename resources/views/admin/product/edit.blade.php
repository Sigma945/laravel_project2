@extends("admin.layout")
@section("title", "修改產品")
@section("content")
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $("#tabs").tabs();
    });

    @if(Session::has("message"))
    Swal.fire("{{ Session::get('message') }}");
    @endif

    function doDelete(formId) {
        Swal.fire({
            title: "確定刪除?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "確定",
            denyButtonText: "放棄"
        }).then((result) => {
            if (result.isConfirmed) {
                document.forms[formId].submit();
            }
        });
    }

    $(document).ready(function(){
        $("#all").click(function(){
          if($(this).is(":checked")){
            $(".chk").attr("checked", true);
          }else{
            $(".chk").attr("checked", false);
          }
        });
    });
</script>

<div class="mx-3">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">基本資料</a></li>
            <li><a href="#tabs-2">產品圖</a></li>
            <li><a href="#tabs-3">規格</a></li>
            <li><a href="#tabs-4">商店</a></li>
        </ul>
        <div id="tabs-1">
            <form method="post" action="/admin/product/update">
                <input type="hidden" name="id" value="{{ $product->id }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-1 text-right">類別</div>
                    <div class="col-3">
                        <select name="layer1" class="form-control">
                            <option value="請選擇類別"></option>
                            @foreach($layer1 as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $product->layer1 ? "selected" : "" }}>{{ $data->layer1_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 text-right">大標題</div>
                    <div class="col-10"><input type="text" class="form-control" name="title" value="{{ $product->title }}"></div>
                </div>
                <div class="row">
                    <div class="col-1 text-right">小標題</div>
                    <div class="col-10"><input type="text" class="form-control" name="sub_title" value="{{ $product->sub_title }}"></div>
                </div>
                <div class="row">
                    <div class="col-1 text-right">首頁</div>
                    <div class="col-1 ">
                        <input type="checkbox" name="home" value="Y" {{ $product->home == "Y" ? "checked" : ""}}>
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <input type="submit" class="btn btn-primary btn-lg" value=" 確 定">
                </div>
            </form>
        </div>

        <div id="tabs-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/admin/photo/add/{{ $product->id }}" class="btn btn-primary text-white">新增</a>&nbsp;&nbsp;
                            <a href="javascript:doDelete('photo')" class="btn btn-danger text-white">刪除</a>
                        </div>
                    </div>

                    <form method="post" action="/admin/photo/delete" id="photo" name="photo">
                        {{ csrf_field() }}
                        <table class="table table-bordered table-hover">
                            <tr class="table-secondary">
                                <th class="text-center"><input type="checkbox" id="all" class="form-check-input"></th>
                                <th class="text-center">圖檔</th>
                            </tr>
                            <tbody id="product">
                                @foreach($photo as $data)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input chk" name="photoId[]" value="{{ $data->id }}">
                                    </td>
                                    <td class="text-center">
                                        <img src="/images/product/{{ $data->photo }}" width="100">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div id="tabs-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/admin/spec/add/{{ $product->id }}" class="btn btn-primary text-white">新增</a>&nbsp;&nbsp;
                            <a href="javascript:doDelete('spec')" class="btn btn-danger text-white">刪除</a>
                        </div>
                    </div>

                    <form method="post" action="/admin/spec/delete" id="spec" name="spec">
                        {{ csrf_field() }}
                        <table class="table table-bordered table-hover">
                            <tr class="table-secondary">
                                <th class="text-center"><input type="checkbox" id="all" class="form-check-input"></th>
                                <th class="text-center">規格名稱</th>
                                <th class="text-center">規格內容</th>
                                <th class="text-center">修改</th>
                            </tr>
                            <tbody id="product">
                                @foreach($spec as $data)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input chk" name="specId[]" value="{{ $data->id }}">
                                    </td>
                                    <td class="text-center">{{ $data->title }}</td>
                                    <td class="text-center">{{ $data->content }}</td>
                                    <td class="text-center">
                                        <a href="/admin/spec/edit/{{ $product->id }}/{{ $data->id }}" class="btn btn-primary text-white">修改</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div id="tabs-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if ( sizeof($shopList) > sizeof($shop) )
                            <a href="/admin/productShop/add/{{ $product->id }}" class="btn btn-primary text-white">新增</a>&nbsp;&nbsp;
                            @endif
                            <a href="javascript:doDelete('shop')" class="btn btn-danger text-white">刪除</a>
                        </div>
                    </div>
                    
                    <form method="post" action="/admin/productShop/delete" id="shop" name="shop">
                        {{ csrf_field() }}
                        <table class="table table-bordered table-hover">
                            <tr class="table-secondary">
                                <th class="text-center"><input type="checkbox" id="all" class="form-check-input"></th>
                                <th class="text-center">商店名稱</th>
                                <th class="text-center">網址</th>
                                <th class="text-center">修改</th>
                            </tr>
                            <tbody id="product">
                                @foreach($shop as $data)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input chk" name="shopId[]" value="{{ $data->id }}">
                                    </td>
                                    <td class="text-center">{{ $data->shopName }}</td>
                                    <td class="text-center">{{ $data->url }}</td>
                                    <td class="text-center">
                                        <a href="/admin/productShop/edit/{{ $product->id }}/{{ $data->id }}" class="btn btn-primary text-white">修改</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection