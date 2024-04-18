@extends("front.layout")
@section("content")
<div data-scroll-watch="" class="fade_in title">
    <div class="breadcrumbs"><a href="/">首頁</a> / <a href="/product/{{ $layer1->id }}">好茶</a> / <span>{{ $product->title }}</span></div>
</div>
<div id="product_detail">
    <div class="main_info">
        @if (!empty($photo) && sizeof($photo)>0)
        <div class="main_pic">
            <div class="m_pic"><img id="zoom_03" src="/images/product/M/{{ $photo[0]->photo }}" data-zoom-image="/images/product/{{ $photo[0]->photo }}"></div>
            <div id="thumb_pic">
                <ul id="gallery_01">
                    @foreach($photo as $data)
                    <li>
                        <a href="#" data-image="/images/product/M/{{ $data->photo }}" data-zoom-image="/images/product/{{ $data->photo }}">
                            <img id="zoom_03" src="/images/product/S/{{ $data->photo }}"></a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="right_info">
            <h3 class="product_tit">{{ $product->title }}</h3>
            <p class="subtitle">{{ $product->sub_title }}</p>
            @if(!empty($spec) && sizeof($spec)>0)
            <table class="prod_table">
                @foreach($spec as $data)
                <tr>
                    <th></th>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->content }}</td>
                </tr>
                @endforeach
            </table>
            @endif

            @if(!empty($shop) && sizeof($shop)>0)
            <div class="shop_link">
                <h6>買好茶</h6>
                @foreach($shop as $data)
                <a href="{{ $data->url }}" target="blank"><p>{{ $data->shopName }}</p></a>
                @endforeach
            </div>
            @endif
        </div>
        
        <div class="mobile_slider">
            <!-- 小尺寸用-->
            <h3 class="product_tit">四季春碳培烏龍茶</h3>
            <p class="subtitle">四季春清香濃烈帶點甜味的滋味，非常容易辨別對剛踏入茶葉領域的人來說是非常好入門的茶款。</p>
            <ul class="bx_mobile">
                <li><img src="product/product/img/p01.jpg"></li>
                <li><img src="product/product/img/p02.jpg"></li>
                <li><img src="product/product/img/p03.jpg"></li>
                <li><img src="product/product/img/p01.jpg"></li>
                <li><img src="product/product/img/p02.jpg"></li>
                <li><img src="product/product/img/p03.jpg"></li>
            </ul>
            <table class="prod_table">
                <tr>
                    <th></th>
                    <td>產區</td>
                    <td>南投</td>
                </tr>
                <tr>
                    <th></th>
                    <td>海拔</td>
                    <td>100-600m</td>
                </tr>
                <tr>
                    <th></th>
                    <td>採收方式</td>
                    <td>機採</td>
                </tr>
                <tr>
                    <th></th>
                    <td>採收季節</td>
                    <td>春、冬</td>
                </tr>
                <tr>
                    <th></th>
                    <td>產品編號</td>
                    <td>12345678910</td>
                </tr>
                <tr>
                    <th></th>
                    <td>發酵度</td>
                    <td>無發酵</td>
                </tr>
                <tr>
                    <th></th>
                    <td>培火度</td>
                    <td>無培火</td>
                </tr>
            </table>
            <div class="shop_link">
                <h6>買好茶</h6><a href="http://www.pcstore.com.tw/" target="blank">
                    <p>PChome</p>
                </a><a href="https://www.rakuten.com.tw/?l-id=rakuten_top_header_logo" target="blank">
                    <p>樂天商城</p>
                </a>
            </div>
        </div>
    </div>
</div>
<h2 class="main_title">關於好茶</h2>
<div class="product_int">
    <div class="int_img"><img src="product/product/img/product_int.jpg"></div>
    <div class="int_text">
        <p>xx身兼茶農與茶商，主打海外市場。產品含各式烏龍茶紅茶、綠茶、不同海拔茶區，在xx都可以找到你想要的好茶！ 與經驗老道的茶師傅合作、所選茶葉品質穩定。茶葉均通過TTB台茶檢驗，無農藥殘留。全世界最好的烏龍茶，大禹嶺茶自產自銷，絕對無假貨之疑慮。熟知市場行情，第一手茶葉進貨，進貨價格較低。</p>
    </div>
    <div class="int_video">
        <div class="video-container">
            <iframe allowfullscreen="" frameborder="0" src="https://www.youtube.com/embed/cdo7xnT5g1U"></iframe>
        </div>
    </div>
</div>
@endsection