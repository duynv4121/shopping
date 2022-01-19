@extends('admin.layout')
@section('title', 'Thêm sản thuộc tính sản phẩm')
@section('main')
    <form action="{{URL::to('/insert-attr')}}" method="POST"  enctype="multipart/form-data">
        {{ csrf_field() }}


        
        <div class="form-group">
            <label>Thuộc tính</label>
            <select name="name" id="inputName" class="form-control">
            <option value="color">Màu sắc</option>
            <option value="size">Size</option>
            </select>
        </div>
     

        <div class="form-group value1">
            <label for="exampleInputEmail1">Màu sản phẩm</label>
            <input type="color" class="form-control" name="value" id="v1" placeholder="Nhập tên sản phẩm">
        </div>

        <div class="form-group value1">
            <label for="exampleInputEmail1">Mô tả màu sắc sản phẩm</label>
            <input type="text" class="form-control" name="description" placeholder="Mô tả màu sắc">
        </div>


        <div style="display:none;" class="form-group value2">
            <label for="exampleInputEmail1">Kích cỡ</label>
            <input type="text" class="form-control" name="" id="v2" value="" placeholder="Nhập tên size sản phẩm">
        </div>

    
        <button type="submit" class="btn btn-primary">Thêm thuộc tính</button>

    </form>
@endsection