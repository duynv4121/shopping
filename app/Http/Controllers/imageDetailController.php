<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\imgDetail;

class imageDetailController extends Controller
{
   
   
    public function create($id)
    {
        $imgDetail = imgDetail::where('id_product', $id)->get();
        return view('admin.product.imgDetail.index', compact(['id','imgDetail']));
    }

    
    public function store(Request $request, $id)
    {
        $fileImg = $request->file('file');
        
        if($fileImg == null){
            return Redirect::back()->withErrors('Vui lòng chọn ảnh trước khi upload');
        }elseif(count($fileImg) > 3 || count($fileImg) < 3){
            return Redirect::back()->withErrors('Số ảnh chỉ được up lên là 3');
        }

        if($fileImg){
            foreach($fileImg as $val){
                $nameImg = $val->getClientOriginalName();
                $val->move('uploads', $nameImg);

                $imgDetail = new imgDetail();
                $imgDetail->id_product = $id;
                $imgDetail->name = $nameImg;
                $imgDetail->save();
                
            }
        }
        return Redirect::back()->withErrors('Thêm ảnh cho sản phẩm thành công');
    }

    

   
    public function update(Request $request)
    {
       
        $id = $request->id;
        $file = $request->file('file');

        $filename = $file->getClientOriginalName();
        $file->move('uploads', $filename);
       
        $imgDetail = imgDetail::find($id);
        $imgDetail->name =  $filename;
        $imgDetail->save();
    }

   
    public function destroy($id)
    {
        $img = imgDetail::find($id);
        $img->delete();
        return redirect()->back();
    }
}
