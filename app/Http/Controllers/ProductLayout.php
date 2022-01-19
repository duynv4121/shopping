<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\imgDetail;
use DB;
use Cart;


class ProductLayout extends Controller
{
    public function index()
    {
        $product = product::all();

        $mini_cart = Cart::content();
        $mini_total = Cart::total();
        return view('layout.index', compact('product', 'mini_cart', 'mini_total'));
    }

    public function detail($id)
    {

        
        $mini_cart = Cart::content();
        $mini_total = Cart::total();
        $product = product::find($id);
        $imgProduct = imgDetail::where('id_product', $id)->limit(3)->get();


        $sqlSize = 'SELECT attrproduct.id, attrproduct.value FROM attrproduct, attr_pro WHERE attr_pro.id_attr = attrproduct.id AND attr_pro.id_pro =' .$id. ' AND attrproduct.type = "size"';
        $size = DB::select($sqlSize);
        $sqlColor = 'SELECT attrproduct.id, attrproduct.description, attrproduct.value FROM attrproduct, attr_pro WHERE attr_pro.id_attr = attrproduct.id AND attr_pro.id_pro = ' .$id. ' AND attrproduct.type = "color"';
        $color = DB::select($sqlColor);
        return view('layout.detail', compact(['product', 'imgProduct', 'size', 'color', 'mini_cart', 'mini_total']));

        //SELECT attrproduct.id, attrproduct.value FROM attrproduct, attr_pro WHERE attr_pro.id_attr = attrproduct.id AND attr_pro.id_pro = 33 AND attrproduct.type = "size"
        //SELECT attrproduct.value FROM attrproduct, attr_pro WHERE attr_pro.id_attr = attrproduct.id AND attr_pro.id_pro = 28 AND attrproduct.type = "color"
    }

    public function search(Request $request)
    {

        $mini_cart = Cart::content();
        $mini_total = Cart::total();

        $data = $request->all();

        $search = product::where('name', 'like', '%'.$data['search_product'].'%')->get();
        return view('layout.search', compact('mini_cart', 'mini_total', 'search'));

    }
}
