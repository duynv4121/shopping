<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\danhMuc;
use App\Components\Recusive;

class DanhMucController extends Controller
{
 
    private $danhmuc;

    public function __construct(danhMuc $danhmuc)
    {
        $this->danhmuc = $danhmuc;
    }

   
  
    public function index()
    {
        $danhmuc = danhMuc::all();
        return view('admin.danhMuc.all_danhMuc', compact(['danhmuc']));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parent_id = '');
        return view('admin.danhMuc.create_danhMuc', compact('htmlOption'));
    }


    public function getCategory($parent_id)
    {
        $data = $this->danhmuc->all();
        $danhMucDeQuy = new Recusive($data);
        $htmlOption = $danhMucDeQuy->danhMucDeQuy($parent_id);

        return $htmlOption;
    }

 
    public function store(Request $request)
    {
        $data = $request->all();
    
        $danhmuc = new danhMuc();
        $danhmuc->name = $data['name'];
        $danhmuc->parent_id = $data['danhmuc'];
        $danhmuc->AnHien = $data['active'];
        $danhmuc->slug_danhmuc	= Str::slug($data['name'], '-');
        $danhmuc->save();
        return redirect()->route('danh-muc.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $danhmuc = $this->danhmuc::find($id);
        $htmlOption = $this->getCategory($danhmuc->parent_id);
        return view('admin.danhMuc.edit_danhMuc', compact(['danhmuc', 'htmlOption']));

    }

  
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $danhmuc = danhMuc::find($id);

        $danhmuc->name = $data['name'];
        $danhmuc->parent_id = $data['danhmuc'];
        $danhmuc->AnHien = $data['active'];
        $danhmuc->slug_danhmuc	= Str::slug($data['name'], '-');
        $danhmuc->save();
        return redirect()->route('danh-muc.index');


    }

   
    public function destroy($id)
    {
       
        $danhmuc = danhMuc::find($id);
        $danhmuc->delete();
        return redirect()->route('danh-muc.index');
    }
}
