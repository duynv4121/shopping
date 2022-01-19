<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\coupon;

class couponController extends Controller
{
   
    public function index()
    {
        $coupon = coupon::all();
        return view('admin.coupon.all-coupon' , compact('coupon'));
    }

 
    public function create()
    {
       
        return view('admin.coupon.create-coupon');
    }

    
    public function store(Request $request)
    {
        $data = $request->all();

        $coupon = new coupon();
        $coupon->code_coupon = $data['code_coupon'];
        $coupon->phuong_thuc = $data['phuong_thuc'];
        $coupon->menh_gia = $data['menh_gia'];
        $coupon->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
