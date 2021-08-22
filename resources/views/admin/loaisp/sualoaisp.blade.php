@extends('admin.master')
@section('title','Sửa Loại SP')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Sửa loại sản phẩm</h1>
    <hr class="sidebar-divider">
    @if(count($errors)>0)
      @foreach ($errors->all() as $err)
        <div class="alert alert-danger">{{$err}}</div>
        @break;
      @endforeach
    @endif
    
    <form action="{{ route('admin.sualoaisp',$loaisp->MaLoaiSP) }}" method="POST">
        @csrf
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Mã loại sản phẩm</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" name="idloaisp" placeholder="Mã loại" value="{{ $loaisp->MaLoaiSP}}" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tên loại sản phẩm</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="tenloaisp" placeholder="Tên loại sản phẩm" value="{{ $loaisp->TenLoaiSP}}" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Mô tả</label>
        <div class="col-sm-4">
          <textarea type="text" class="form-control" name="mota" required>{{$loaisp->MoTa}}</textarea>
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