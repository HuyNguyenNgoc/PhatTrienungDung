@extends('master')
@section('title','Đăng ký')
@section('content')

<!---start-content----->
<div class="content">
	<div>
	   <div class="container">
		  <div class="register">
          @if(count($errors)>0)
          @foreach ($errors->all() as $err)
              <div class="alert alert-danger">{{$err}}</div>
              @break;
          @endforeach
          @endif
          <form action="{{route('user.register')}}" method="POST"> 
          @csrf
				 <div class="register-top-grid">
					<h3>Đăng ký tài khoản</h3>
					 <div class="wow fadeInLeft" data-wow-delay="0.4s">
						<span>Họ tên<label>*</label></span>
						<input type="text" name="hoten" value="{{ old('hoten') }}" > 
					 </div>
					 
					 <div class="wow fadeInRight" data-wow-delay="0.4s">
						 <span>Địa chỉ email<label>*</label></span>
						 <input type="email" name="email" value="{{ old('email') }}"> 
            </div>
            <div class="wow fadeInLeft" data-wow-delay="0.4s">
              <span>Số điện thoại<label>*</label></span>
              <input type="tel" name="sdt" value="{{ old('sdt') }}"> 
            </div>
            <div class="wow fadeInRight" data-wow-delay="0.4s">
                <span>Ngày sinh<label>*</label></span>
                
                <input type="date" name="ngaysinh"  value="{{ old('ngaysinh') }}"> 
            </div>

            <div class="wow fadeInRight" data-wow-delay="0.4s">
                <span>Địa chỉ <label>*</label></span>
                <input type="text" name="diachi"  value="{{ old('diachi') }}"> 
            </div>
            
            <div class="wow fadeInLeft" data-wow-delay="0.4s">
                <span>Giới tính<label>*</label></span>
                <label class="radio-button" style="margin-right: 20px">
                    <input type="radio" name="gioitinh" checked="checked"  value="1">
                    <span class="label-visible">
                      <span class="fake-radiobutton"></span>
                      Nam
                    </span>
                  </label>
                  
                  <label class="radio-button">
                    <input type="radio" name="gioitinh"  value="2">
                    <span class="label-visible">
                      <span class="fake-radiobutton"></span>
                      Nữ
                    </span>
                  </label>
            </div>
                    
					 <div class="clearfix"> </div>
					   
					 </div>
				     <div class="register-bottom-grid"> 
                        
							 <div class="wow fadeInLeft" data-wow-delay="0.4s">
								<span>Mật khẩu<label>*</label></span>
								<input type="password" name="password">
							 </div>
							 <div class="wow fadeInRight" data-wow-delay="0.4s">
								<span>Nhập lại mật khẩu<label>*</label></span>
								<input type="password" name="repassword">
							 </div>
                     </div>
                     <div class="clearfix"></div>
				<div class="register-but">
                    <input type="submit" value="Đăng ký">
                    <input type="reset" value="Reset">
                    <div class="clearfix"> </div>				   
				</div>
				</form>
				
		    </div>
	    </div>
	</div>
</div>
        
@endsection