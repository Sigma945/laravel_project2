<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>全端班_Project2</title>
    <meta name="description" content="本專案使用技術包含Laravel(middleware, model, view, Controller, API, migration, Export), Vue, Jquery, ajax, mysql">
    <meta name="keywords" content="php, laravel, bootstrap, vue, mysql, MVC, XAMPP, Jquery">
    <!--header的CSS-->
    <link href="/css/front/commons/header/fonts/FontAwesome/font-awesome.css" rel="stylesheet">
    <link href="/css/front/commons/header/bootstrap.min.css" rel="stylesheet">
    <link href="/css/front/commons/header/animate.css" rel="stylesheet">
    <link href="/css/front/commons/header/bootsnav.css" rel="stylesheet">
    <link href="/css/front/commons/header/overwrite.css" rel="stylesheet">
    <link href="/css/front/commons/header/style.css" rel="stylesheet">
    <link href="/css/front/commons/header/skins/color.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
    <style type="text/css">
        @import url(http://fonts.googleapis.com/earlyaccess/cwtexhei.css);
    </style>
    
    <!--GotoTop的CSS-->
    <link rel="stylesheet" type="text/css" href="/css/front/commons/gototop/style.css"><!--footer的CSS-->
    <link rel="stylesheet" type="text/css" href="/css/front/commons/footer/footer.css">
    <!-- 每頁title的CSS-->
    <link rel="stylesheet" type="text/css" href="/css/front/commons/else/title.css">
    
    @if (Request::is("/"))
    <!-- 首頁AD的CSS-->
    <link rel="stylesheet" href="/css/front/index/effects.min.css">
    <link rel="stylesheet" href="/css/front/index/index.css">
    <!-- video的CSS-->
    <link rel="stylesheet" href="/css/front/index/video.css">
    @endif

    @if (Request::is("product", "product/*"))
    <link href="/css/front/product/jquery.bxslider.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/front/product/web_product.css">
    <link rel="stylesheet" href="/css/front/product/product.css">
    <!-- 關於好茶 CSS-->
    <link rel="stylesheet" href="/css/front/product/product_int.css">
    <link rel="stylesheet" href="/css/front/product/video.css">
    @endif

    @if (Request::is("product/list/*"))
    <link href="/css/front/product/effects.min.css" rel="stylesheet">
    <link href="/css/front/product/style.css" rel="stylesheet"><!--ScrollWatch滾動淡入-->
    <style>
      .fade_in {
      transition: opacity 2s;
      }
      .fade_in.scroll-watch-in-view {
      opacity: 1;
      }
    </style>
    @endif
  </head>

  <body>  <!-- oncontextmenu="window.event.returnValue=false"關閉網頁右鍵選單 阻擋使用者看網頁原始碼 -->
    <!-- Start Navigation-->
    <nav class="navbar navbar-default bootsnav">
      <!-- Start Top Search-->
      <div class="top-search">
        <div class="container">
          <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" placeholder="Search Products" class="form-control"><span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="attr-nav lang_bar">
          <ul>
            <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
          </ul>
        </div>
        <div class="navbar-header">
          <button type="button" data-toggle="collapse" data-target="#navbar-menu" class="navbar-toggle"><i class="fa fa-bars"></i></button>
          <!-- <a href="index.html" class="navbar-brand">
            <img src="images/logo.png" class="logo" style="width:150px">
          </a> -->
        </div>
        <div id="navbar-menu" class="collapse navbar-collapse">
          <ul data-in="fadeInDown" data-out="fadeOutUp" class="nav navbar-nav navbar-right">
            <li>
                <a href="/about">
                    <span class="nav_img">
                        <img src="/images/icon/icon_about.svg" alt="">
                    </span>
                <p class="nav_p">關於</p></a>
            </li>
            <li>
                <a href="/news">
                  <span class="nav_img">
                    <img src="/images/icon/news_icon.svg" alt="">
                  </span>
                  <p class="nav_p">最新消息</p>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    <span class="nav_img">
                      <img src="/images/icon/icon_product.svg" alt="">
                    </span>
                  <p class="nav_p">好茶</p>
                </a>
              @if(!empty(session()->get("layer1")))
              <ul class="dropdown-menu">
                @foreach(session()->get("layer1") as $data)
                <li><a href="/product/list/{{ $data->id }}">{{ $data->layer1_name }}</a></li>
                @endforeach
              </ul>
              @endif
            </li>
            <li>
                <a href="/knowl">
                    <span class="nav_img">
                        <img src="/images/icon/icon_knowl.svg" alt="">
                    </span>
                <p class="nav_p">品茶知識</p></a>
            </li>
            <li>
                <a href="/contact">
                    <span class="nav_img">
                        <img src="/images/icon/icon_contact.svg" alt="">
                    </span>
                <p class="nav_p">聯絡我們</p></a>
            </li>
          </ul>
          <ul class="lang_bar">
            <li class="lang"><a href="#">中文/</a></li>
            <li class="lang"><a href="#">En/</a></li>
            <li class="lang"><a href="#">日本語</a></li>
          </ul>
        </div>
      </div>
    </nav>

    @yield("content")

    <div class="footer">
      <div class="nav">
        <ul>
          <li><a href="about.html">關於</a></li>
          <li><a href="news.html">最新消息</a></li>
          <li><a href="productlist_1.html">好茶</a></li>
          <li><a href="knowl.html">品茶知識</a></li>
          <li><a href="contact.html">聯絡我們</a></li>
        </ul>
      </div>
      <!-- <div class="logo"><a href="index.html"><img src="/images/logo.png" style="width:150px"></a></div> -->
      <div class="info">
        <div class="line">
          <a href="#" target="_blank">地址: </a><br> 
          <a href="#">電話: </a><br> 
          <a href="#">Email: </a>
        </div>
      </div>
      <div class="copyright"><a href="copyright.html">智慧財產權聲明</a> © 2017 . All Rights Reserved </div>
    </div>
    <!-- Scroll to Top button selector-->
    <div><a class="to-top"><img src="/images/gototop/gototop.svg" alt=""></a></div>
    <!--header的JS-->
    <script>window.jQuery || document.write('<script src="/js/front_js/commons/header/jquery-1.11.0.min.js "><\/script>')</script>
    <script src="/js/front_js/commons/header/bootstrap.min.js "></script>
    <script src="/js/front_js/commons/header/bootsnav_2.js "></script>
    <!--GotoTop的JS-->
    <script src="/js/front_js/commons/gototop/jquery.toTop.min.js"></script>
    <script>
      jQuery(function($){
      // Plugin activation (basic)
      // $('.to-top').toTop();
      // Plugin activation with options
      $('.to-top').toTop({
      //options with default values
      autohide: true,  //boolean 'true' or 'false'
      offset: 250,     //numeric value (as pixels) for scrolling length from top to hide automatically
      speed: 650,      //numeric value (as mili-seconds) for duration
      right: 20,       //numeric value (as pixels) for position from right
      bottom: 60       //numeric value (as pixels) for position from bottom
      });
      });
    </script>
    
    @if (Request::is("product", "product/*"))
    <!-- product_photo_JS-->
    <script src="/js/front_js/product/jquery-2.1.3.min.js"></script>
    <script src="/js/front_js/product/jquery.bxslider.js"></script>
    <script type="text/javascript" src="/js/front_js/product/jquery.elevateZoom-3.0.8.min.js"></script>
    <script src="/js/front_js/product/web_product.js"></script>
    @endif

    @if (Request::is("product/layer1/*"))
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/front_js/product/jquery.lazyload.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
      $("img").lazyload({
      effect: "fadeIn"
      });
      });
    </script>
    @endif
  </body>