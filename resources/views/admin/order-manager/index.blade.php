@extends('admin.layout')
@section('title', 'Tất cả đơn hàng')
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
                <th>Đơn hàng số</th>
                <th>Mã đơn hàng</th>
                <th>Trạng thái đơn hàng</th>
                <th>Xem đơn hàng</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <?php $s = 1; ?>
            <tbody>
                @foreach ($order as $val)
                    <tr>
                        <td>{{$s++}}</td>
                        <td>{{$val->id_shipping}}</td>
                        <td>{{$val->code_checkout}}</td>                
                        <td>{{($val->status == 1)?"Đơn hàng mới":"Đã xử lí"}}</td>
                        <th><a href="{{URL::to("order-detail/$val->code_checkout")}}"><i style="cursor: pointer; font-size:30px;" class="fas fa-folder-plus"></i></a></th>
                        <td><a href="{{route('product.edit', $val->id)}}"><i style="cursor: pointer; font-size:30px;" class="fas fa-edit"></i></a></td>
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