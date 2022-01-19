<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\user;
use App\Models\shipping;
use App\Models\orderDetail;
use App\Models\coupon;

class orderManager extends Controller
{
    public function index()
    {

        $order = order::orderBy('created_at', 'DESC')->get();
        return view('admin.order-manager.index', compact('order'));
    }

    public function orderDetail($id)
    {
        $order = order::where('code_checkout', $id)->get();
        foreach($order as $val){
            $id_user = $val->id_user;
            $id_shipping = $val->id_shipping;
        }
        $user = user::where('id', $id_user)->first();

        $shipping = shipping::where('id', $id_shipping)->first();
    
        $orderDetail = orderDetail::with('product')->where('checkout_code', $id)->get();

        foreach($orderDetail as $val){
            $coupon_code = $val->coupon;
        }

        $coupon = coupon::where('code_coupon', $coupon_code)->first();

        
        return view('admin.order-manager.order-detail-manager', compact('user', 'shipping', 'orderDetail', 'coupon'));
    }
}
