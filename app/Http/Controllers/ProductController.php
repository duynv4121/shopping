<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\danhMuc;
use App\Models\product;
use App\Components\recusive;
use Illuminate\Support\Str;
use App\Models\attrproduct;
use App\Models\attrPro;
class ProductController extends Controller
{
    private $danhmuc;

    public function __construct(danhMuc $danhmuc)
    {
        $this->danhmuc = $danhmuc;
    }

    public function getCategory($parent_id)
    {
        $data = $this->danhmuc->all();
        $danhMucDeQuy = new Recusive($data);
        $htmlOption = $danhMucDeQuy->danhMucDeQuy($parent_id);

        return $htmlOption;
    }
   
    public function index()
    {
        $product = product::all();
        return view('admin.product.all_product', compact('product'));
    }

 
    public function create()
    {

        $attrColor = attrproduct::where('type', 'color')->get();
        $attrSize = attrproduct::where('type', 'size')->get();
        $htmlOption = $this->getCategory($parent_id ='');
        return view('admin.product.create_product', compact(['htmlOption', 'attrColor', 'attrSize']));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // dd($data);


        $danhmuc = danhMuc::where('id', $data['danhmuc'])->value('name');
        $danhmuc_slug = Str::slug($danhmuc, '-');


        $image = $request->file('image');
        if($image){  
            $name_image = $image->getClientOriginalName();
            $image->move('uploads', $name_image);
        }else{
            $name_image = 'error.jpg';
        }

    


        $product = new product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->material = $data['material'];
        $product->number = $data['number'];
        $product->image = $name_image;
        $product->id_danhmuc = $data['danhmuc'];
        $product->slug_danhmuc = $danhmuc_slug;
        $product->slug_product = Str::slug($data['name']);
        $product->AnHien = $data['active'];
        $product->content = $data['content'];
        $product->save();

       
        foreach($data['id-atrr'] as $val){
            $attr_pro = new attrPro();
            $attr_pro->id_pro = $product->id;
            $attr_pro->id_attr = $val;
            $attr_pro->save();
        }






        return redirect()->route('product.index');

    

        

    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $product = product::find($id);
        $danhmuc = danhMuc::all();
        return view('admin.product.edit_product', compact(['product', 'danhmuc']));
    }

   
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $image_old = $data['image_old'];

        $danhmuc = danhMuc::where('id', $data['danhmuc'])->value('name');
        $danhmuc_slug = Str::slug($danhmuc, '-');


        $image = $request->file('image');
        if($image){  
            $name_image = $image->getClientOriginalName();
            $image->move('uploads', $name_image);
        }else{
            $name_image =  $image_old;
        }

        $product = product::find($id);
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->material = $data['material'];
        $product->number = $data['number'];
        $product->image = $name_image;
        $product->id_danhmuc = $data['danhmuc'];
        $product->slug_danhmuc = $danhmuc_slug;
        $product->slug_product = Str::slug($data['name']);
        $product->AnHien = $data['active'];
        $product->content = $data['content'];
        $product->save();
        return redirect()->route('product.index');

    }

    
    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }


    public function createAttr()
    {
        return view('admin.product.attrProduct.add_atrr');
    }

    public function insert(Request $request)
    {
        $data = $request->all();

        $attr = new attrproduct();
        $attr->value = Str::upper($data['value']);
        $attr->type = $data['name'];
        $attr->description = Str::ucfirst($data['description']);
        $attr->save();

        
        
    }
}
