@extends('admin.master')
@section('title','Sửa sản phẩm')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Sửa sản phẩm</h1>
    <hr class="sidebar-divider">
    @if(count($errors)>0)
        @foreach ($errors->all() as $err)
            <div class="alert alert-danger">{{$err}}</div>
            @break;
        @endforeach
    @endif

    @if(Session::has('thanhcong'))  
      <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
    @endif

    <form enctype="multipart/form-data" action="{{ route('admin.suasanpham',$sanpham->MaSP) }}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mã sản phẩm</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="masanpham" placeholder="Mã sản phẩm" value="{{ $sanpham->MaSP}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm" value="{{ $sanpham->TenSP}}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Loại sản phẩm</label>
            <div class="col-sm-3">
                <select class="form-control" name="loaisp">
                    @foreach ($loaisp as $lsp)
                    <option value="{{$lsp->MaLoaiSP}}" {{($lsp->MaLoaiSP==$malsp) ? 'selected' : null}}>{{$lsp->TenLoaiSP}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Đơn vị tính</label>
            <div class="col-sm-2">
                <select class="form-control" name="dvt">
                    <option>Hộp</option>
                    <option>Cái</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Đơn giá</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="dongia" value="{{ $sanpham->DonGia}}" placeholder="Đơn giá" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Số lượng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="soluong" value="{{ $sanpham->SoLuong}}" placeholder="Số lượng" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mô tả</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control" id="mota" name="mota" required>{{ $sanpham->MoTa}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nguyên liệu</label>
            <div class="col-sm-8">
                <textarea type="text" id="nguyen_lieu" class="form-control" name="nguyen_lieu" required>{{ $sanpham->nguyen_lieu}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Hình ảnh</label>
            <div class="col-sm-4">
                <div class="custom-file">
                    <input type="file" name="image">
                </div>
                
                @if(!empty($sanpham->Image))
                <input type="hidden" name="oldimage" value="{{$sanpham->Image}}">
                <img src="{{ asset('/images/img-SanPham/small/'.$sanpham->Image)}}" style="width:60px;height:40px">  | <a href="admin/xoa-img-sanpham/{{$sanpham->MaSP}}" style="color:crimson">xóa</a>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Sửa</button>
            </div>
        </div>
    </form>

</div>

@endsection

@section('script')
    <script>
        CKEDITOR.replace( 'mota' );
        CKEDITOR.replace( 'nguyen_lieu' );
    </script>
@endsection