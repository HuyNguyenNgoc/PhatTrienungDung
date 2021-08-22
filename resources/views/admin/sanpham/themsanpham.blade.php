@extends('admin.master')
@section('title','Thêm sản phẩm')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Thêm sản phẩm</h1>
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

    <form enctype="multipart/form-data" action="{{route('admin.themsanpham')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mã sản phẩm</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="masanpham" placeholder="Mã sản phẩm" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tên sản phẩm</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Loại sản phẩm</label>
            <div class="col-sm-3">
                <select class="form-control" name="loaisp">
                    @foreach ($loaisp as $lsp)
                    <option value="{{$lsp->MaLoaiSP}}">{{$lsp->TenLoaiSP}}</option>
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
                <input type="text" class="form-control" name="dongia" placeholder="Đơn giá" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Số lượng</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="soluong" placeholder="Số lượng" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mô tả</label>
            <div class="col-sm-8">
                <textarea type="text" id="mota" class="form-control" name="mota" required></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nguyên liệu</label>
            <div class="col-sm-8">
                <textarea type="text" id="nguyen_lieu" class="form-control" name="nguyen_lieu" required></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Hình ảnh</label>
            <div class="col-sm-4">
                <div class="custom-file">
                    <input type="file" name="image">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Thêm</button>
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