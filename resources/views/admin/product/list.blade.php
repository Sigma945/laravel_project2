@extends("admin.layout")
@section("title", "產品管理")
@section("content")
<script>
    function doSearch(keyword)
    {
        $.ajax({
            url: "/admin/product/search",
            type: "post",
            data: {
                keyword: keyword,
                _token: "{{ csrf_token() }}",
            },
            success: function(msg){
                $("#product").html(msg);
            }
        });
    }
</script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="/admin/product/add" class="btn btn-primary">新增</a>&nbsp;&nbsp;
                <a href="javascript:deleteAll(list)" class="btn btn-danger">刪除</a>&nbsp;&nbsp;
                <input type="text" id="keyword" placeholder="關鍵字搜尋" onkeyup="doSearch(this.value)">
            </div>
        </div>

        <form method="post" action="/admin/product/delete" id="list" name="list">
            {{ csrf_field() }}
            <table class="table table-bordered table-hover">
                <tr class="table-secondary">
                    <th class="text-center"><input type="checkbox" id="all" class="form-check-input"></th>
                    <th class="text-center">分類</th>
                    <th class="text-center">大標題</th>
                    <th class="text-center">小標題</th>
                    <th class="text-center">首頁</th>
                    <th class="text-center">修改</th>
                </tr>
                <tbody id="product">
                    @foreach($list as $data)
                    <tr>
                        <td class="text-center">
                        <input type="checkbox" class="form-check-input chk" name="id[]" value="{{ $data->id }}">
                        </td>
                        <td class="text-center">{{ $data->layer1_name  }}</td>
                        <td class="text-center">{{ $data->title  }}</td> 
                        <td class="text-center">{{ $data->sub_title  }}</td> 
                        <td class="text-center">{{ $data->home }}</td>  
                        <td class="text-center"><a href="/admin/product/edit/{{ $data->id }}" class="btn btn-success">修改</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <!-- 分頁 -->
        {{ $list->links() }}
    </div>
</div>
@endsection