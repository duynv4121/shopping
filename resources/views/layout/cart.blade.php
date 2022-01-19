@extends('layout.layout')
@section('main')



    @if (Cart::count() > 0)
        <div class="container">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                    Home
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <a href="products.html" class="stext-109 cl8 hov-cl1 trans-04">
                    Men
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <span class="stext-109 cl4">
                    Lightweight Jacket
                </span>
            </div>
        </div>

        <div class="bg0 p-t-75 p-b-85">
            <div class="container">
                <div class="row">
                    <div style="padding: 0" class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Price</th>
                                        <th class="column-4">Quantity</th>
                                        <th class="column-5">Total</th>
                                        <th style="padding-right: 30px;" class="column-6">Del</th>
                                    </tr>

                                    @foreach ($data as $val)
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="uploads/{{$val->options->img}}" alt="IMG">
                                                </div>
                                                <div>Size: {{$val->options->size}}</div>
                                                <div>Màu: {{$val->options->color}}</div>
                                            </td>
                                            <td  class="column-2">{{$val->name}}</td>
                                            <td class="column-3">{{number_format($val->price)}}</td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div style="display: none;" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="btn-quantity fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                   <form action="" method="post">
                                                        @csrf
                                                        <input style="width: 100%" class="mtext-104 cl3 txt-center num-product quantity" type="number" name="num-product2" value="{{$val->qty}}" onchange="update(this.value, '{{$val->rowId}}', {{$val->options->number_db}})">
                                                   </form>

                                                    <div style="display: none;" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">{{number_format($val->qty * $val->price)}}</td>
                                            <td>
                                                <a style="font-size: 16px; color: #000;" href="{{URL::to('/delete', $val->rowId)}}"><i class="fas fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <form style="display: flex;" action="{{URL::to('/check-coupon')}}" method="post">
                                        @csrf
                                        @if (Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $val)
                                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 coupon" type="text" name="coupon" value="{{$val['coupon_code']}}" placeholder="Coupon Code">    
                                            @endforeach
                                        @else
                                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 coupon" type="text" name="coupon" placeholder="Coupon Code">    
                                        @endif
                                        
                                        <div onclick="checkCoupon()" class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                            Apply coupon
                                        </div>
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                    </form>
                                </div>

                                <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    <a style="color: #000;" href="{{URL::to('/delete/all')}}">DEL ALL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Cart Totals
                            </h4>
                            @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key => $val)
                                    @if ($val['phuong_thuc'] == 1)
                                        <div class="flex-w flex-t  p-b-13">
                                            <div class="size-208">
                                                <span class="stext-110 cl2">
                                                    Subtotal:
                                                </span>
                                            </div>
                                            <div class="size-209">
                                                <span class="mtext-110 cl2">                                              
                                                    @php
                                                        $total_cart = str_replace(array('.', ',') , '', str_replace('.00', '', $total))
                                                    @endphp
                                                    {{number_format($total_cart)}} VNĐ
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-t p-b-13">
                                            <div class="size-208">
                                                <span class="stext-110 cl2">
                                                    Mã giảm giá:
                                                </span>
                                            </div>
                                            <div class="size-209">
                                                <span class="mtext-110 cl2">
                                                    {{$val['coupon_code']}}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-t p-b-13">
                                            <div class="size-208">
                                                <span class="stext-110 cl2">
                                                   Giảm giá: 
                                                </span>
                                            </div>
                                            <div class="size-209">
                                                <span class="mtext-110 cl2">
                                                    {{$val['menh_gia']}} %
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-t p-b-13">
                                            <div class="size-208">
                                                <span class="stext-110 cl2">
                                                   Số tiền giảm 
                                                </span>
                                            </div>
                                            <div class="size-209">
                                                <span class="mtext-110 cl2">
                                                    @php
                                                        $total_cart = str_replace(array('.', ',') , '', str_replace('.00', '', $total));
                                                        $sotiengiam = ($total_cart * $val['menh_gia'])/100;
                                                    @endphp
                                                    {{number_format($sotiengiam)}} VNĐ
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex-w flex-t  p-b-13">
                                            <div class="size-208">
                                                <span class="stext-110 cl2">
                                                    Subtotal:
                                                </span>
                                            </div>
                                            <div class="size-209">
                                                <span class="mtext-110 cl2">                                              
                                                    @php
                                                        $total_cart = str_replace(array('.', ',') , '', str_replace('.00', '', $total))
                                                    @endphp
                                                    {{number_format($total_cart)}} VNĐ
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-t p-b-13">
                                            <div class="size-208">
                                                <span class="stext-110 cl2">
                                                    Mã giảm giá:
                                                </span>
                                            </div>
                                            <div class="size-209">
                                                <span class="mtext-110 cl2">
                                                    {{$val['coupon_code']}}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex-w flex-t p-b-13">
                                            <div class="size-208">
                                                <span class="stext-110 cl2">
                                                   Giảm giá: 
                                                </span>
                                            </div>
                                            <div class="size-209">
                                                <span class="mtext-110 cl2">
                                                    {{number_format($val['menh_gia'])}} VNĐ
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                
                            @else
                                <div class="flex-w flex-t  p-b-13">
                                    <div class="size-208">
                                        <span class="stext-110 cl2">
                                            Subtotal:
                                        </span>
                                    </div>
                                    <div class="size-209">
                                        <span class="mtext-110 cl2">                                              
                                            @php
                                                $total_cart = str_replace(array('.', ',') , '', str_replace('.00', '', $total));
                                            @endphp
                                            {{number_format($total_cart)}} VNĐ
                                        </span>
                                    </div>
                                </div>
                            @endif
                            

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        Shipping:
                                    </span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <p class="stext-111 cl6 p-t-2">
                                        There are no shipping methods available. Please double check your address, or contact us if you need any help.
                                    </p>

                                    <div class="p-t-15">
                                        <span class="stext-112 cl8">
                                            Tính phí vận chuyển
                                        </span>

                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                            <select class="js-select2" name="time">
                                                <option>Select a country...</option>
                                                <option>USA</option>
                                                <option>UK</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                                        </div>

                                        <div class="bor8 bg0 m-b-22">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                        </div>

                                        <div class="flex-w">
                                            <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                                Update Totals
                                            </div>
                                        </div>

                                    </div>

                                    <form action="{{URL::to('checkout')}}" method="post">
                                        @csrf
                                        <div class="p-t-15">
                                            <span class="stext-112 cl8">
                                                Thông tin người nhận
                                            </span>
                                            <div class="bor8 bg0 m-b-22">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên người nhận">
                                            </div>
    
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số điện thoại">
                                            </div>
    
                                            <div class="bor8 bg0 m-b-22">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa chỉ">
                                            </div>
    
                                            <div class="bor8 bg0 m-b-22">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Total:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                      
                                        @if (Session::get('coupon'))
                                            @foreach (Session::get('coupon') as $val)
                                                @if ($val['phuong_thuc'] == 1)
                                                    @php
                                                        $total_cart = str_replace(array('.', ',') , '', str_replace('.00', '', $total));
                                                        $sotiengiamphamtram = ($total_cart * $val['menh_gia'])/100;
                                                    @endphp
                                                    {{number_format($total_cart -  $sotiengiamphamtram)}} VNĐ
                                                @else
                                                    {{number_format($total_cart - $val['menh_gia'])}} VNĐ
                                                @endif
                                            @endforeach
                                        @else
                                            @php
                                                $total_cart = str_replace(array('.', ',') , '', str_replace('.00', '', $total));
                                            @endphp
                                            {{number_format($total_cart)}} VNĐ
                                        @endif
                                    </span>
                                </div>
                            </div>

                            @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key => $val)
                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20"  type="hidden" value="{{$val['coupon_code']}}" name="coupon">
                                @endforeach
                            @else
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20"  type="hidden" value="không có" name="coupon">
                            @endif

                            <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Proceed to Checkout
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

    @else
       <div style="display: flex;">
           <img style="margin: 0 auto; width: 40%" src="uploads/empty-cart.png" alt="">
       </div>
    @endif
   

    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
@endsection


   