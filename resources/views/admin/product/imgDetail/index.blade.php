@extends('admin.layout')
@section('title', 'Thêm ảnh cho sản phẩm')
@section('main')
    <form action="{{URL::to('/storeImg', $id)}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
    
        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="file[]" class="custom-file-input" accept="image/*" multiple>
                <label class="custom-file-label" for="exampleInputFile">Chọn hình ảnh sản phẩm</label>
              </div>
            </div>
          </div> 
          @if($errors->any())
            <h4>{{$errors->first()}}</h4>
          @endif      
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
      </form>

      @if (count($imgDetail)>0)
        <div class="card-body table-responsive p-0">
          <table class="table">
            <thead>
              <tr>
                <th>STT</th>
                <th>Tên ảnh</th>
                <th>Hình ảnh</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <?php $s = 1; ?>
            <tbody>
                @foreach ($imgDetail as $val)
                  <tr>
                    
                      <td>{{$s++}}</td>
                      <td>{{$val->name}}</td>
                      <td>
                        <div><img style="width:100px; height:120px" src="uploads/{{$val->name}}" alt=""></div>
                      <form  method="POST" enctype="multipart/form-data">
                 
                        <input class="imgDetailUpdate" id="file" type="file" name="imgDetail" accept="image/*" data-id="{{$val->id}}">
                      </form>
                      </td>
                     
                      <td>
                        <form id="form_id" action="{{URL::to('/deleteImg', $val->id)}}" method="post">
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
      @endif

@endsection