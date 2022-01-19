@extends('admin.layout')
@section('title', 'Thêm sản phẩm mới')
@section('main')
    <form action="{{route('product.store')}}" method="POST"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Giá sản phẩm</label>
            <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Chất liệu</label>
            <input type="text" class="form-control" name="material" placeholder="Nhập chất liệu sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Số lượng</label>
            <input type="text" class="form-control" name="number" placeholder="Nhập số lượng sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Chọn hình ảnh sản phẩm</label>
              </div>
            </div>
          </div>

        <div class="form-group">
            <label>Chọn danh mục</label>
            <select name="danhmuc" class="form-control">
            <option value="0">Danh mục cha</option>
            {{-- @foreach ($danhmuc as $val)
                <option value="{{$val->id}}">{{$val->name}}</option>
            @endforeach --}}
            {{!! $htmlOption !!}}
            </select>
        </div>


        <label for="">Màu sản phẩm</label>
        @foreach ($attrColor as $val)
            <div class="[ form-group ]">
                <input type="checkbox" name="id-atrr[]" value="{{$val->id}}" id="fancy-checkbox-default-{{$val->id}}" autocomplete="off" />
                <div class="[ btn-group ]">
                    <label for="fancy-checkbox-default-{{$val->id}}" style="background-color: {{$val->value}}" class="[ btn ]">
                        <span class="[ glyphicon glyphicon-ok ]"></span>
                    </label>
                    <label for="fancy-checkbox-default-{{$val->id}}" class="[ btn btn-default]">
                        {{ $val->description }}
                    </label>
                </div>
            </div>
        @endforeach


        <label for="">Size</label>
        @foreach ($attrSize as $val)
            <div name="size" class="form-group">
                <input type="checkbox" name="id-atrr[]" value="{{$val->id}}" id="fancy-checkbox-default-{{$val->id}}"/>
                <div class="btn-group">
                    <label for="fancy-checkbox-default-{{$val->id}}" class="btn btn-default">
                        {{ $val->value }}
                    </label>
                </div>
            </div>
        @endforeach
        


        <div class="form-group">
            <label>Ẩn hiện</label>
            <select name="active" class="form-control">
            <option value="0">Hiện</option>
            <option value="1">Ẩn</option>
            </select>
        </div>
        

               
        <div class="card-body pad">
            <div class="mb-3">
                <textarea name="content" class="textarea" placeholder="Mô tả cho sản phẩm"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
        </div>
                
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>

    </form>
@endsection