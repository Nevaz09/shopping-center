<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $judulhalaman = "Halaman Products";
        $products = Product::paginate(5);
        return view('admin.product.index', compact(['judulhalaman', 'products']));
    }
    public function add(){
        $judulhalaman = "Edit Products";
        $category = Category::all();
        return view('admin.product.add', compact(['judulhalaman', 'category']));
    }

    public function insert(Request $request){
        $products = new Product();
        if($request->hasFile('image')){
            $request->file('image')->move('assets/uploads/product', $request->file('image')->getClientOriginalName());
            $products->image = $request->file('image')->getClientOriginalName();
        }
        $products->id_category = $request->id_category;
        $products->name = $request->name;
        $products->slug = $request->slug;
        $products->small_description = $request->small_description;
        $products->description = $request->description;
        $products->original_price = $request->original_price;
        $products->selling_price = $request->selling_price;
        $products->qty = $request->qty;
        $products->tax = $request->tax;
        $products->status = $request->status == TRUE ?'1':'0';
        $products->trending = $request->trending == TRUE ?'1':'0';
        $products->meta_tittle = $request->meta_tittle;
        $products->meta_descrip = $request->meta_descrip;
        $products->meta_keywords = $request->meta_keywords;
        $products->save();
        $pesan = "Data Product Di Tambahkan";
        return redirect('products')->with('succes', $pesan);
    }

    public function edit($id){
        $judulhalaman = "Edit Product";
        $products = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit-product', compact(['judulhalaman', 'products', 'category']));
    }

    public function update(Request $request, $id){
        $products = Product::find($id);
        if($request->hasFile('image')){ 
            $path = 'asset/uploads/product/'.$products->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $request->file('image')->move('assets/uploads/product', $request->file('image')->getClientOriginalName());
            $products->image = $request->file('image')->getClientOriginalName();
        }
        $products->name = $request->name;
        $products->slug = $request->slug;
        $products->small_description = $request->small_description;
        $products->description = $request->description;
        $products->original_price = $request->original_price;
        $products->selling_price = $request->selling_price;
        $products->qty = $request->qty;
        $products->tax = $request->tax;
        $products->status = $request->status == TRUE ?'1':'0';
        $products->trending = $request->trending == TRUE ?'1':'0';
        $products->meta_tittle = $request->meta_tittle;
        $products->meta_descrip = $request->meta_descrip;
        $products->meta_keywords = $request->meta_keywords;
        $products->update();
        $pesan = "Product Berhasil Di Update";
        return redirect('products')->with('success', $pesan);
    }
    public function destroy($id){
        $products = Product::find($id);
        if($products->image){
            $path = 'assets/uploads/product'.$products->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $products->delete();
        $pesan = "Product Berhasil Menghapus ";
        return redirect('products')->with('success', $pesan);
    }
    public function destroyall(Request $request)
    {
        $itemsid = $request->itemsid;
        // dd($itemsid);
        if(is_null($itemsid)){
            $pesan ="Silahkan Pilih Item Yang Akan Dihapus";
            return redirect('products')->with('warning', $pesan);
        }else{
            Product::whereIn('id', $itemsid)->delete();
            $pesan = "Items Berhasil Di Hapus";
            return redirect('products')->with('success', $pesan);   
        }
    }
}
