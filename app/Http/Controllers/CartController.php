<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Cart;
use Mail;
use App\Models\shipping;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\coupon;
use Session;
use Alert;

class CartController extends Controller
{
    public function addCart(Request $request, $id)
    {
        $data = $request->all(); 
        $product = product::find($id);



        if($data['number_db'] < $data['quantity']){
            return redirect()->back()->with('message', 'Xin lỗi! Chúng tôi chỉ còn '.$data['number_db'].' sản phẩm');
        }else{
            Cart::add([
                'id' => $id,
                'name' => $product->name,
                'qty' => $data['quantity'], 
                'price' => $product->price, 
                'weight' => 0,
                'options' => ['size' => $data['size'], 
                              'color' => $data['color'],
                              'img' => $product->image,
                              'number_db' => $product->number,
                            ],
            ]);
            return redirect('/shopping-cart');
        }
        
    }

    public function getCart()
    {
         
        $mini_cart = Cart::content();
        $mini_total = Cart::total();

        $data = Cart::content();
        $total = Cart::total();

        return view('layout.cart', compact('mini_cart','total', 'mini_total', 'data'));
    }


    public function remove($id)
    {
        if($id == 'all'){
            Session::forget('coupon');
            Cart::destroy();
        }else{
            Cart::remove($id);
        }
        return redirect('/shopping-cart');
    }


    public function update(Request $request)
    {
        $data = $request->all();
        Cart::update($data['rowId'], $data['qty']);
    }


    public function checkout(Request $request)
    {
        $data['info'] = $request->all();
        $data['items'] = Cart::content();
        $data['total'] = Cart::total();
        $email = $request->email;
        $infoCheckout = $request->all();
        
        $shipping = new shipping();
        $shipping->name = $infoCheckout['name'];
        $shipping->phone = $infoCheckout['phone'];
        $shipping->email = $infoCheckout['email'];
        $shipping->address = $infoCheckout['address'];
        $shipping->save();

        $order = new order();
        $code_checkout = substr(md5(microtime()),rand(0,26),5);
        $order->id_user = Session::get('id_user');
        $order->id_shipping =  $shipping->id;
        $order->code_checkout = $code_checkout;
        $order->save();

        if(Cart::content()){
            foreach(Cart::content() as $val){
                $orderDetail = new orderDetail();
                $orderDetail->checkout_code = $code_checkout;
                $orderDetail->product_id = $val->id;
                $orderDetail->product_name = $val->name;
                $orderDetail->product_price = $val->price;
                $orderDetail->product_quantity = $val->qty;
                $orderDetail->color = $val->options->color;
                $orderDetail->size = $val->options->size;
                $orderDetail->coupon = $infoCheckout['coupon'];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $orderDetail->created_at = now();	
                $orderDetail->save();
            }
        }


        foreach(Cart::content() as $val){
            $product = product::find($val->id);
            $product->number = $product->number - $val->qty;
            $product->save();
        }

        // Mail::send('layout.mail', $data, function ($message) use($email) {
        //     $message->from('duynv41201@gmail.com', 'DiDiShop');
        //     $message->to($email, $email);
        //     $message->subject('Xác nhận đơn hàng DiDiShop');
        // });

        Cart::destroy();
        Session::forget('coupon');
        echo "Cảm ơn bạn đã mua hàng";

        
    }


    public function checkCoupon(Request $request)
    {
        $data = $request->all();
        $checkCoupon = coupon::where('code_coupon', $data['coupon'])->first();


        if($checkCoupon == true){
            $count_coupon = $checkCoupon->count();
            if($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $cou[] = array(
                        'coupon_code' => $checkCoupon->code_coupon,
                        'phuong_thuc' => $checkCoupon->phuong_thuc,
                        'menh_gia' => $checkCoupon->menh_gia,
                    );
                    Session::put('coupon', $cou);
                }else{
                    $cou[] = array(
                        'coupon_code' => $checkCoupon->code_coupon,
                        'phuong_thuc' => $checkCoupon->phuong_thuc,
                        'menh_gia' => $checkCoupon->menh_gia,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Áp dụng mã giảm giá thành công');
            }
        }else{
            return redirect()->back()->with('message', 'Mã giảm giá không có giá trị');
        }

    }
}
