@extends('admin.layout')
@section('title', 'Tất cả danh mục')
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
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th>Chỉnh sửa</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <?php $s = 1; ?>
            <tbody>
                @foreach ($danhmuc as $val)
                    <tr>
                        <td>{{$s++}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{($val->AnHien == 0)?"Hiện":"Ẩn"}}</td>
                        <td><a href="{{route('danh-muc.edit', $val->id)}}"><i style="cursor: pointer; font-size:30px;" class="fas fa-edit"></i></a></td>
                        <td>
                          <form id="form_id" action="{{route('danh-muc.destroy', $val->id)}}" method="post">
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