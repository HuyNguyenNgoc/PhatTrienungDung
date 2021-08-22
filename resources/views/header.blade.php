<header class="main_header_area five_header">
			<div class="top_header_area row m0">
				<div class="container">
					<div class="float-left">
						<a href="tell:+18004567890"><i class="fa fa-phone" aria-hidden="true"></i> 090900000 </a>
						<a href="mainto:info@cakebakery.com"><i class="fa fa-envelope-o" aria-hidden="true"></i>infor@gmail.com</a>
					</div>
					<div class="float-right">
						
						<ul class="h_search list_style">
							<li><a class="popup-with-zoom-anim" href="#test-search"><i class="fa fa-search"></i></a></li>
							<li><a class="popup-with-zoom-anim" href="#test-cart"><i class="fa fa-shopping-cart"></i> (@if(Session::has('cart')) {{(Session('cart')->tongSo)}}@else Trống @endif)</a></li>
			
							
							@if(Session::has('userSession'))
							<li class="dropdown submenu">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fas fa-user"></i> {{(Session('userSession'))}}</a>
								<ul class="dropdown-menu">
									<!-- <li><a href="" style="color: #303339"><i class="fa fa-user-circle"></i> Quản lý tài khoản</a></li> -->
									<li><a href="{{Route('giohang')}}" style="color: #303339"><i class="fa fa-shopping-basket"></i> Giỏ hàng</a></li>
									<li><a href="khach-hang-logout" style="color: #303339"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
								</ul>
							</li>
							@else
							<li><a style="color:#94c9d9;font-size: 13px;font-family: 'Open Sans', sans-serif;" href="khach-hang-login">Đăng nhập</a>|<a style="color:#94c9d9;font-size: 13px" href="register" >Đăng ký</a></li>
							@endif
						</ul>
					</div>	

				</div>
			</div>
			<div class="main_menu_two">
				<div class="container">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
						<a class="navbar-brand" href="{{route('trang-chu')}}"><img src="source/img/teacake-logo2.png" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="my_toggle_menu">
                            	<span></span>
                            	<span></span>
                            	<span></span>
                            </span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav justify-content-end">
								<li class="{{ Request::is('index') ? 'active' : null}} ">
									<a href="{{route('trang-chu')}}">Trang chủ</a>
								</li>
								<li class="dropdown submenu {{ Request::is(('loai-san-pham/*')) ? 'active' : null}}">
										<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >Sản phẩm</a>
										<ul class="dropdown-menu">
											@foreach ($loaisp as $lsp)
											
											<li class="{{ Request::is('loai-san-pham/'.$lsp->MaLoaiSP) ? 'active' : null}} "><a href="{{route('loai-san-pham', $lsp->MaLoaiSP)}}">{{$lsp->TenLoaiSP}}</a></li>
											@endforeach					
										</ul>
								</li>
								
								
								<li class="dropdown submenu">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
									<ul class="dropdown-menu">
										<li><a href="{{route('blog')}}">Công thức làm bánh</a></li>
									</ul>
								</li>
								<li class="dropdown submenu">
									<a href="{{route('giohang')}}">Giỏ hàng</a></li>
								</li>
								<li class="dropdown submenu">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Về chúng tôi</a>
									<ul class="dropdown-menu">
										<li><a href="{{route('about')}}">About Us</a></li>
										<li><a href="{{route('chef')}}">Our Chefs</a></li>
									</ul>
								</li>
								<li><a href="{{Route('contact')}}">Liên hệ</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
</header>