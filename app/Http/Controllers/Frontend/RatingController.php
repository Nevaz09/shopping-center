<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function addRating(Request $request){
        $stars_rated = $request->product_rating;
        $product_id = $request->product_id;

        $product_check = Product::where('id', $product_id)->where('status','0')->first();
        if($product_check){
            $verifikasi_pembelian = Order::where('orders.user_id', Auth::id())
                    ->join('order_items', 'orders.id', 'order_items.order_id')
                    ->where('order_items.product_id', $product_id)->get();
            if($verifikasi_pembelian->count() > 0){
                $existing_rating = Rating::where('user_id', Auth::id())->where('product_id', $product_id)->first();
                if($existing_rating){
                    $existing_rating->stars_rated = $stars_rated;
                    $existing_rating->update();
                } else{ 
                    Rating::create([
                        'user_id' => Auth::id(),
                        'product_id' => $product_id,
                        'stars_rated' => $stars_rated,
                    ]);
                }
                $pesan ="Terimakasih telah memberikan penilaian untuk product ini";
                return redirect()->back()->with('success', $pesan);
            } else{
                $pesan1 = "Anda tidak dapat menilai suatu produk tanpa melakukan pembelian terlebih dahulu..!"; 
                return redirect()->back()->with('status', $pesan1);
            }
        } else {
            $pesan2 = "Tautan yang Anda ikuti rusak..!";
            return redirect()->back()->with('status', $pesan2);
        }
    }
}
