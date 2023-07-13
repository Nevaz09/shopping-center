<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // public function indexReview($product_slug){
    //     $product = Product::where('slug', $product_slug)->where('status', '0')->first();

    //     if($product){
    //         $product_id = $product->id;
    //         $verifikasi_pembelian = Order::where('orders.user_id', Auth::id())
    //                 ->join('order_items', 'orders.id', 'order_items.order_id')
    //                 ->where('order_items.product_id', $product_id)->get();
    //         return view('frontend.products.view', compact(['product', 'verifikasi_pembelian']));
    //     } else{
    //         $pesan1 = "Tauntan yang anda ikuti rusak"; 
    //         return redirect('view-product')->with('success', $pesan1);
    //     }
    // }

    public function addReview(Request $request){
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->where('status', '0')->first();

        if($product){
            $user_review = $request->user_review;
            $new_review = Review::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'user_review' => $user_review
            ]);
            $category_slug = $product->category->slug;
            $product_slug = $product->slug;
            if($new_review){
                $pesan = "Terimakasih telah memberikan ulasan product";
                return redirect('view-product/'.$category_slug.'/'.$product_slug)->with('success', $pesan);
            }
        } else{
            $category_slug = $product->category->slug;
            $product_slug = $product->slug;
            $pesan1 = "Halaman yang anda ikut rusak";
            return redirect('view-product/'.$category_slug.'/'.$product_slug)->with('status', $pesan1);
        }
    }
}
