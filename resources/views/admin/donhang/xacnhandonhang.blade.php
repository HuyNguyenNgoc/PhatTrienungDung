@extends('admin.master')
@section('title','Chi tiết đơn hàng')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Chi tiết đơn hàng</h1>
    <hr class="sidebar-divider">
    @if(empty($errors))
    <div class="alert alert-danger">{{$errors}}</div>
    @endif

    @if(Session::has('error'))  
      <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif

    <form enctype="multipart/form-data" action="{{ url('/admin/donhang/xac-nhan-don-hang-2/'.$donhang->MaDDH) }}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mã đơn đặt hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="maddh" value="#{{$donhang->MaDDH}}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Khách hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tenkhachhang" value="{{$donhang->MaKH}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tên người nhận</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tennguoinhan" value="{{$donhang->TenNguoiNhan}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">SĐT người nhận</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tensanpham" value="{{$donhang->sdt}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Thời gian giao hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tg_giaohang" value="{{$donhang->ThoiGianGiaoHang}}" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Thời gian đặt hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tg_dathang" value="{{$donhang->created_at}}" readonly>
            </div>
        </div>

        <div class="form-group row">
                <label class="col-sm-2 col-form-label">Địa chỉ giao hàng</label>
                <div class="col-sm-4">
                    <textarea type="text" class="form-control" name="diachi_giaohang" readonly>{{$donhang->DiaChiGiaoHang}}</textarea>
                </div>
            </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Ghi chú</label>
            <div class="col-sm-4">
                <textarea type="text" class="form-control" name="ghichu" readonly>{{$donhang->GhiChu}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Sản phẩm</label>
            <div class="col-sm-4">
                @foreach ($sp_dh as $sp)
                <li>{{$sp->TenSP}} x{{$sp->sl_dh}} ({{number_format($sp->DonGia)}}đ)</li>
                @endforeach
                
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tổng tiền</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tongtien" value="{{number_format($tongtien)}}đ" placeholder="Đơn giá" readonly>
            </div>
        </div>

        

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nhân viên giao hàng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tongtien" value="{{$nv_giaohang}}" placeholder="" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tình trạng đơn hàng</label>
            <div class="col-sm-3">
                <select class="form-control" name="tt_donhang">   
                    <option value="1" {{($tt_hoadon=="1") ? 'selected' : null}}>Đã xử lý</option>
                    <option value="2" {{($tt_hoadon=="2") ? 'selected' : null}}>Đang giao hàng</option>
                    <option value="3" {{($tt_hoadon==="3") ? 'selected' : null}}>Hoàn thành</option>
                </select>
            </div>  
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success">Duyệt</button>
            </div>
        </div>
    </form>


</div>

@endsection