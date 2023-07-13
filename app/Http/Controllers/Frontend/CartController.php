<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request){
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;
        if(Auth::check()){
            $product_check = Product::where('id', $product_id)->first();
            if($product_check){
                if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                    $pesan = " Sudah Di Masukkan Kedalam Kerjanjang";
                    return response()->json(['status' => $product_check->name.$pesan]);
                } else {
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();
                    $pesan = " Di Masukkan Dalam Keranjang";
                    return response()->json(['status' => $product_check->name.$pesan]);
                }
            }
        } else{
            $pesan = "Silahkan Login Terlebih Dahulu";
            return response()->json(['status' => $pesan]);
        }
    }

    public function viewCart(){
        $judulhalaman="Keranjang Saya";
        
        $cartItem = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact(['cartItem', 'judulhalaman']));
    }

    public function deleteProduct(Request $request){
        if(Auth::check()){
            $product_id = $request->product_id;
            if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                $pesan = "Pesanan Berhasil Di Hapus";
                return response()->json(['status' => $pesan]);
            }
        } else{
            $pesan = "Silahkan Login Terlebih Dahulu";
            return response()->json(['status' => $pesan]);
        }
    }

    public function updateProduct(Request $request){
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;
        if(Auth::check()){
            if(Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()){
                $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart->product_qty = $product_qty;
                $cart->update(); 
                $pesan = "Pesanan Berhasil Di Update";
                return response()->json(['status' => $pesan]);
            }
        }
    }

    public function cartcount(){
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }
}
