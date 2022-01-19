@extends('admin.layout')
@section('title', 'Thêm mã giảm giá')
@section('main')
    <form action="{{route('coupon.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Mã giảm</label>
            <input type="text" class="form-control" name="code_coupon" placeholder="Nhập mã giảm">
        </div>

        <div class="form-group">
            <label>Phương thức giảm</label>
            <select name="phuong_thuc" class="form-control">
                <option value="1">Giảm theo %</option>
                <option value="2">Giảm theo VNĐ</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mệnh giá</label>
            <input type="text" class="form-control" name="menh_gia" placeholder="Nhập số % hoặc số tiền bạn muốn giảm">
        </div>
     
        <button type="submit" class="btn btn-primary">Thêm mã giảm giá</button>

    </form>
@endsection