@extends('master')
@section('title','Đăng nhập')
@section('content')

<!--================End Main Header Area =================-->
{{-- <section class="banner_area">
    <div class="container">
        <div class="banner_text">
            <h3>Product Details</h3>
            <ul>
                <li><a href="{{route('trang-chu')}}">Trang chu</a></li>
                <li><a href=""></a></li>
            </ul>
        </div>
    </div>
</section> --}}
<!--================End Main Header Area =================-->
<!---start-content----->
<div class="content">
	<div class="container">    
		<div class="login-page">
            @if(count($errors)>0)
            @foreach ($errors->all() as $err)
                <div class="alert alert-danger">{{$err}}</div>
                @break;
            @endforeach
            @endif
            @if(Session::has('thanhcong'))  
            <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
            @endif
            {{-- @if($errors->has('Email'))  
                <div class="alert alert-danger">{{ $errors->first('Email') }}</div>
            @endif --}}
			   <div class="account_grid">
                <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s"  style="float: right">
                    <h3>Khách hàng mới</h3>
                  <p>Bằng cách tạo tài khoản, bạn sẽ có thể chuyển qua quy trình thanh toán nhanh hơn, lưu trữ nhiều địa chỉ giao hàng, xem và theo dõi đơn hàng của bạn trong tài khoản của bạn và hơn thế nữa.</p>
                  <a class="acount-btn" href="register">Tạo tài khoản</a>
                </div>
			   <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s" style="float: left">
			  	<h3>Đăng nhập</h3>
				<p>Nếu bạn có tài khoản, vui lòng đăng nhập.</p>
                <form  action="{{route('user.KhachHangLogin')}}" method="POST">
                @csrf
				  <div>
                    <span>Email<label>*</label></span>
                    <input type="email" name="email"> 
				  </div>
				  <div>
                    <span>Mật khẩu<label>*</label></span>
                    <input type="password" name="password"> 
                </div>
                <label class="checkbox"><input type="checkbox" name="remember" checked=""><i> </i>Nhớ mật khẩu</label>
                <div class="clearfix"> </div>
				  <a class="forgot" href="#">Quên mật khẩu?</a>
                  <input type="submit" value="Đăng nhập">
                  
			    </form>
			   </div>	
			   <div class="clearfix"> </div>
             </div>
             
		   </div>
    </div>
</div>

@endsection