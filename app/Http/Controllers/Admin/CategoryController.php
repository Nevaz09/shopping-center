<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $judulhalaman ="Halaman Category";
        $category = Category::paginate(5);
        return view('admin.category.index', compact(['judulhalaman', 'category']));
    }
    public function add()
    {
        $judulhalaman = "Create Category";
        return view('admin.category.add', compact(['judulhalaman']));
    }
    public function insert(Request $request)
    {
        $category = new Category();
        if($request->hasFile('image')){
            $request->file('image')->move('assets/uploads/category', $request->file('image')->getClientOriginalName());
            $category->image = $request->file('image')->getClientOriginalName();
        }
        // if($request->hasFile('image'))
        // {
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time().'.'.$ext;
        //     $file->move('assets/uploads/category/',$filename);
        //     $category->image = $filename;
        // }
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status == TRUE ?'1':'0';
        $category->popular = $request->popular == TRUE ?'1':'0';
        $category->meta_tittle = $request->meta_tittle;
        $category->meta_descrip = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();
        $pesan = "Category Berhasil Di TambahKan";
        return redirect('categories')->with('success', $pesan);
    }
    
    public function edit($id){
        $judulhalaman = "Edit Category";
        $category = Category::find($id);

        return view('admin.category.edit-category', compact(['judulhalaman', 'category']));
    }
    
    public function update(Request $request, $id){
        $category = Category::find($id);
        if($request->hasFile('image')){
            $path = 'asset/uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $request->file('image')->move('assets/uploads/category', $request->file('image')->getClientOriginalName());
            $category->image = $request->file('image')->getClientOriginalName();
        }
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status == TRUE ?'1':'0';
        $category->popular = $request->popular == TRUE ?'1':'0';
        $category->meta_tittle = $request->meta_tittle;
        $category->meta_descrip = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->update();
        $pesan = "Category Berhasil Di Update ";
        return redirect('categories')->with('success', $pesan);
    }

    public function destroy($id){
        $category = Category::find($id);
        if($category->image){
            $path = 'assets/uploads/category'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $category->delete();
        $pesan = "Category Berhasil Menghapus ";
        return redirect('categories')->with('success', $pesan);
    }
    
    public function destroyall(Request $request)
    {
        $itemsid = $request->itemsid;
        // dd($itemsid);
        if(is_null($itemsid)){
            $pesan ="Silahkan Pilih Item Yang Akan Dihapus";
            return redirect('categories')->with('warning', $pesan);
        }else{
            Category::whereIn('id', $itemsid)->delete();
            $pesan = "Items Berhasil Di Hapus";
            return redirect('categories')->with('success', $pesan);   
        }
    }
}
