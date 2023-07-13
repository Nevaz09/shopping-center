<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class WishlistController extends Controller
{
    public function index(){
        $judulhalaman = "My Wishlist";
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact(['judulhalaman', 'wishlist']));
    }

    public function addWishlist(Request $request){
        if(Auth::check()){
            $product_id = $request->product_id;
            if(Product::find($product_id)){
                $list = new Wishlist();
                $list->product_id = $product_id;
                $list->user_id = Auth::id();
                $list->save();
                $pesan ="Di Tambahkan Kedalam Daftar Keinginan";
                return response()->json(['status' =>$pesan]);
            } else{
                $pesan = " Product Tidak Ada";
                return response()->json(['status' => $pesan]);
            }
        } else{
            $pesan = "Silahkan Login Terlebih Dahulu";
            return response()->json(['status'=> $pesan]);
        }
    }

    public function deleteWishlistItem(Request $request){
        if(Auth::check()){
            $product_id = $request->product_id;
            if(Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $wishlist->delete();
                $pesan = "Item Berhasil Di Hapus Dari Daftar Keinginan";
                return response()->json(['status'=> $pesan]);
            } else{
                $pesan = "Silahkan Login Terlebih Dahulu";
                return response()->json(['status' => $pesan]);
            }
        }
    }

    public function wishlistcount(){
        $list = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $list]);
    }
}
