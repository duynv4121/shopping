@extends('admin.layout')
@section('title', 'Thêm phí ')
@section('main')
    <form action="{{route('danh-muc.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên danh mục</label>
            <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục">
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

        <div class="form-group">
            <label>Ẩn hiện</label>
            <select name="active" class="form-control">
            <option value="0">Hiện</option>
            <option value="1">Ẩn</option>
            </select>
        </div>
        
     
        <button type="submit" class="btn btn-primary">Thêm danh mục</button>

    </form>
@endsection