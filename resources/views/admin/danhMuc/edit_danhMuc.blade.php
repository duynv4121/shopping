@extends('admin.layout')
@section('title', 'Chỉnh sửa danh mục')
@section('main')
    <form action="{{route('danh-muc.update', $danhmuc->id)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên danh mục</label>
            <input type="text" value="{{$danhmuc->name}}" class="form-control" name="name" placeholder="Nhập tên danh mục">
        </div>

        <div class="form-group">
            <label>Chọn danh mục</label>
            <select name="danhmuc" class="form-control">
                <option value="0">Danh mục cha</option>
                {{!! $htmlOption !!}}
            </select>
        </div>

        <div class="form-group">
            <label>Ẩn hiện</label>
            <select name="active" class="form-control">
            <option @if ($danhmuc->AnHien == 0) selected @endif value="0">Hiện</option>
            <option @if ($danhmuc->AnHien == 1) selected @endif value="1">Ẩn</option>
            </select>
        </div>  
        <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
    </form>
@endsection