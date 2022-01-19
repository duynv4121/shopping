@extends('admin.layout')
@section('title', 'Cập nhật sản phẩm')
@section('main')
    <form action="{{route('product.update', $product->id)}}" method="POST"  enctype="multipart/form-data">
        {{ csrf_field() }}

        {{ method_field('PATCH') }}
        <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên sản phẩm</label>
            <input type="text" value="{{$product->name}}" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Giá sản phẩm</label>
            <input type="text" value="{{$product->price}}" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Chất liệu</label>
            <input type="text" value="{{$product->material}}" class="form-control" name="material" placeholder="Nhập chất liệu sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Số lượng</label>
            <input type="text" value="{{$product->number}}" class="form-control" name="number" placeholder="Nhập số lượng sản phẩm">
        </div>

        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Chọn hình ảnh sản phẩm</label>    
              </div>
            </div>
            <img style="width:100px; height:120px" src="uploads/{{$product->image}}" alt="">
            <input type="hidden" name="image_old" value="{{$product->image}}">
          </div>

        <div class="form-group">
            <label>Chọn danh mục</label>
            <select name="danhmuc" class="form-control">
            
            @foreach ($danhmuc as $val)
                @if ($val->id == $product->id_danhmuc)
                    <option selected value="{{$val->id}}">{{$val->name}}</option>
                @else
                    <option value="{{$val->id}}">{{$val->name}}</option>
                @endif    
            @endforeach
            {{-- {{!! $htmlOption !!}} --}}
            </select>
        </div>

        <div class="form-group">
            <label>Ẩn hiện</label>
            <select name="active" class="form-control">
            <option  @if ($product->AnHien == 0) selected @endif value="0">Hiện</option>
            <option  @if ($product->AnHien == 0) selected @endif value="1">Ẩn</option>
            </select>
        </div>
        
               
        <div class="card-body pad">
            <div class="mb-3">
                <textarea name="content" class="textarea" placeholder="Mô tả cho sản phẩm"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$product->content}}</textarea>
            </div>
        </div>
                
        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>

    </form>
@endsection