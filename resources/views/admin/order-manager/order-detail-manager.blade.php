@extends('admin.layout')
@section('title', 'Đơn hàng chi tiết')
@section('main')
<div class="row">



    <h5>Thông tin đăng nhập</h5>
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <?php $s = 1; ?>
                    <tbody>
                        <tr>
                            <td>{{$s++}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>                
                        </tr>
                    </tbody>
                </table>
            </div>
       
        </div>
  
    </div>




    <h5>Thông tin vận chuyển đơn hàng</h5>
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table">
                    <thead>
                        <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        </tr>
                    </thead>
                    <?php $s = 1; ?>
                    <tbody>
                        <tr>
                            <td>{{$s++}}</td>
                            <td>{{$shipping->name}}</td>
                            <td>{{$shipping->phone}}</td>
                            <td>{{$shipping->address}}</td>
                            <td>{{$shipping->email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <h5>Sản phẩm đơn hàng</h5>
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Size</th>
                            <th>Màu sắc</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Mã giảm giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <?php
                        $s = 1; 
                        $subTotal = 0;
                    ?>

                    <tbody>
                        @foreach ($orderDetail as $val)
                            @php
                                $total = ($val->product_price * $val->product_quantity);
                                $subTotal += $total;
                            @endphp
                            <tr>
                                <td>{{$s++}}</td>
                                <td>{{$val->product_name}}</td>      
                                <td>{{$val->size}}</td>                
                                <td>{{$val->color}}</td>
                                <td>{{number_format($val->product_price)}}</td>      
                                <td>{{$val->product_quantity}}</td>
                                @if ($coupon == true)
                                    <td>{{$coupon->code_coupon}}</td>
                                @else
                                    <td>Không có</td>
                                @endif     
                                <td>{{number_format($total)}} VNĐ</td>      
                            </tr>
                        @endforeach  
                            @if ($coupon['phuong_thuc'] == 1)
                                <tr>
                                    <td colspan="8">
                                        <h5>Tổng đơn hàng: {{number_format($subTotal)}} VNĐ</h5>
                                        <h5>Giảm giá: {{number_format(($subTotal * $coupon->menh_gia)/100)}} VNĐ</h5>
                                        <h5>Tổng thanh toán: {{number_format($subTotal - (($subTotal * $coupon->menh_gia)/100))}} VNĐ</h5>
                                    </td>
                                </tr>    
                            @elseif ($coupon['phuong_thuc'] == 2)
                                <tr>
                                    <td colspan="8">
                                        <h5>Tổng đơn hàng: {{number_format($subTotal)}} VNĐ</h5>
                                        <h5>Giảm giá: {{number_format($coupon->menh_gia)}} VNĐ</h5>
                                        <h5>Tổng thanh toán: {{number_format($subTotal - $coupon->menh_gia)}} VNĐ</h5>
                                    </td>
                                </tr>    
                            @else
                                <tr>
                                    <td colspan="8">
                                        <h5>Tổng thanh toán: {{number_format($subTotal)}} VNĐ</h5>
                                    </td>
                                </tr> 
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>

@endsection