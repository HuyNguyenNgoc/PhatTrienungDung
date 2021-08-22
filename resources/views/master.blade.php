    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="source/img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>@yield('title') | Cake - Bakery</title>
        <base href="{{asset('')}}">


        <!-- Icon css link -->
        <link href="source/css/font-awesome.min.css" rel="stylesheet">
        <link href="source/vendors/linearicons/style.css" rel="stylesheet">
        <link href="source/vendors/flat-icon/flaticon.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="source/css/bootstrap.min.css" rel="stylesheet">

        <!-- Rev slider css -->
        <link href="source/vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="source/vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="source/vendors/revolution/css/navigation.css" rel="stylesheet">
        <link href="source/vendors/animate-css/animate.css" rel="stylesheet">

        <!-- Extra plugin css -->
        <link href="source/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="source/vendors/magnifc-popup/magnific-popup.css" rel="stylesheet">
        <link href="source/vendors/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="source/vendors/nice-select/css/nice-select.css" rel="stylesheet">
        <link href="source/vendors/datetime-picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>



        <link href="source/css/style.css" rel="stylesheet">
        <link href="source/css/loginstyle.css" rel="stylesheet">
        <link href="source/css/responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

    <body>

        <!--================Main Header Area =================-->
        @include('header')
        <!--================End Main Header Area =================-->

        <!--================Content Area =================-->
        @yield('content')
        <!--================End Content Area =================-->


        <!--================Footer Area =================-->
        @include('footer')
        <!--================End Footer Area =================-->

        <!--================Search Box Area =================-->
        <div class="search_area zoom-anim-dialog mfp-hide" id="test-search">
            <div class="search_box_inner">
                <h3><i class="fa fa-search" aria-hidden="true"></i> Tìm kiếm</h3>
                <div class="input-group">
                    <form  action="{{ url('/tim-kiem') }}" method="get">
                        <input type="text" name="key" class="form-control" placeholder="Nhập từ khóa...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                aria-hidden="true"></i></button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
        @if(Session::has('cart'))
        <div class="cart_area zoom-anim-dialog mfp-hide" id="test-cart">
            <div class="search_box_inner">
                <h2><i class="fa fa-cart-plus"></i> Giỏ bánh</h2>
                <div class="input-group">
                    @foreach($sanpham_cart as $spcart)
                    <div class="cart-item">
                        <div class="media">
                            <a class="pull-left">
                                <img src="{{ asset('/images/img-SanPham/small/'.$spcart['item']['Image'])}}" alt="" style="width:100px"></a>                                
                            <div class="media-body">
                                <span class="cart-item-title">{{$spcart['item']['TenSP']}}</span>
                                {{-- <input type="number" value="{{$spcart['qty']}}"> --}}
                                
                                {{-- <div class="input-group">
                                        <span class="cart-item-amount">{{$spcart['qty']}}</span>
                                    <button id="down" class="btn-info" onclick=" down('1')"><span class="glyphicon glyphicon-minus"></span>-</button>
                                    <input type="text" id="myNumber" class="input-number" value="{{$spcart['qty']}}" />
                                    <button id="up" class="btn-info" onclick="up('10')"><span class="glyphicon glyphicon-plus"></span>+</button>
                                </div> --}}
                                <p>Số lượng: {{$spcart['qty']}}</p>
                                <span class="cart-item-amount"><span>{{number_format($spcart['price'])}}đ</span></span>
                            </div>
                        <a class="cart-item-delete" href="{{route('xoagiohang',$spcart['item']['MaSP'])}}"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                        </div>
                    </div>              
                    @endforeach
                    <div class="cart-caption">
                        <div class="cart-total text-right">Tổng tiền:
                            <span class="cart-total-value">{{number_format(Session('cart')->tongTien)}}đ</span></div>
                        <div class="clearfix"></div>

                        <div class="center">
                            <div class="space10">&nbsp;</div>
                            <a class="btn btn-info" href="giohang"><i class="fa fa-cart-plus"></i> Giỏ hàng</a>
                            <a class="btn btn-success" href="mua-hang" style="float: right">>>>Đặc hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="cart_area zoom-anim-dialog mfp-hide" id="test-cart" style="width:300px">
            <div class="search_box_inner">
                <div class="input-group">
                    <h2 style="height:10px"><i class="fa fa-cart-plus"></i> Giỏ hàng trống</h2>
                </div>
            </div>
        </div>
        @endif


        <!--================End Search Box Area =================-->





        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="source/js/jquery-3.2.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="source/js/popper.min.js"></script>
        <script src="source/js/bootstrap.min.js"></script>
        <!-- Rev slider js -->
        <script src="source/vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="source/vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="source/vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="source/vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="source/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="source/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="source/vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <!-- Extra plugin js -->
        <script src="source/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="source/vendors/magnifc-popup/jquery.magnific-popup.min.js"></script>
        <script src="source/vendors/datetime-picker/js/moment.min.js"></script>
        <script src="source/vendors/datetime-picker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="source/vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="source/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="source/vendors/lightbox/simpleLightbox.min.js"></script>

        <script src="source/js/theme.js"></script>
        <script type="text/javascript">
            $('#datetimepicker1').datetimepicker({
                allowInputToggle: true,
                });
        </script>
                
        <script>
                function up(max) {
                    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
                    if (document.getElementById("myNumber").value >= parseInt(max)) {
                        document.getElementById("myNumber").value = max;
                    }
                }
                function down(min) {
                    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
                    if (document.getElementById("myNumber").value <= parseInt(min)) {
                        document.getElementById("myNumber").value = min;
                    }
                }
            </script>
            
    </body>

    </html>