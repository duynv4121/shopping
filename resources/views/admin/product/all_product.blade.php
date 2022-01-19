@extends('admin.layout')
@section('title', 'Tất cả sản phẩm')
@section('main')
<div class="row">
    <div class="col-12">
      <div class="card">
       
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table">
            <thead>
              <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Chất liệu</th>
                <th>Số lượng</th>
                <th>Trạng thái</th>
                <th>Thêm ảnh chi tiết</th>
                <th>Cập nhật</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <?php $s = 1; ?>
            <tbody>
                @foreach ($product as $val)
                    <tr>
                        <td>{{$s++}}</td>
                        <td>{{$val->name}}</td>
                        <td><img style="width:100px; height:120px" src="uploads/{{$val->image}}" alt=""></td>
                        <td>{{number_format($val->price)}} VNĐ</td>
                        <td>{{$val->material}}</td>
                        <td>{{$val->number}}</td>                     
                        <td>{{($val->AnHien == 0)?"Hiện":"Ẩn"}}</td>
                        <th><a href="{{URL::to("createImg/$val->id")}}"><i style="cursor: pointer; font-size:30px;" class="fas fa-folder-plus"></i></a></th>
                        <td><a href="{{route('product.edit', $val->id)}}"><i style="cursor: pointer; font-size:30px;" class="fas fa-edit"></i></a></td>
                        <td>
                          <form id="form_id" action="{{route('product.destroy', $val->id)}}" method="post">
                            @csrf
                            {{ method_field('delete') }}
                            <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-warning" type="submit">Xóa</button>                          
                          </form>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection