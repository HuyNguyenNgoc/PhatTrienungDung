@extends('admin.master')
@section('title','Thêm Loại SP')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Thêm loại sản phẩm</h1>
    <hr class="sidebar-divider">
    @if(count($errors)>0)
      @foreach ($errors->all() as $err)
        <div class="alert alert-danger">{{$err}}</div>
        @break;
      @endforeach
    @endif
    
    <form action="{{route('admin.themloaisp')}}" method="POST">
        {{csrf_field()}}
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Mã loại sản phẩm</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="idloaisp" placeholder="Mã loại"  required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tên loại sản phẩm</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="tenloaisp" placeholder="Tên loại sản phẩm"  required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Mô tả</label>
        <div class="col-sm-4">
          <textarea type="text" class="form-control" name="mota"  required></textarea>
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