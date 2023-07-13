<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $featured_product = Product::where('trending', '1')->take(15)->get();
        $featured_category = Category::where('popular', '1')->take(15)->get();
        $judulhalaman = "Home Shopping-center";
        return view('frontend.index', compact(['judulhalaman', 'featured_product', 'featured_category']));
    }
    public function category(){
        $featured_category = Category::where('status', '0')->take(15)->get();
        $judulhalaman = "All Category";
        return view('frontend.category', compact(['judulhalaman', 'featured_category']));
    }
    public function viewCategory($slug){
        if(Category::where('slug', $slug)->exists()){
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('id_category', $category->id)->where('status', '0')->get();
            $judulhalaman = "$category->name";
            return view('frontend.products.index', compact(['category', 'products', 'judulhalaman']));
        } else{
            $pesan = "Product Masih Kosong";
            return redirect('/')->with('warning', $pesan);
        }
    }
    public function viewProduct($category_slug, $product_slug,){
        if(Category::where('slug', $category_slug)->exists()){
            if(Product::where('slug', $product_slug)->exists()){
                $product = Product::where('slug', $product_slug)->where('status', '0')->first();
                $ratings = Rating::where('product_id', $product->id)->get();
                $rating_sum = Rating::where('product_id', $product->id)->sum('stars_rated');
                $user_rating = Rating::where('product_id', $product->id)->where('user_id', Auth::id())->first();
                $reviews = Review::where('product_id', $product->id)->get();

                if($product){
                    $product_id = $product->id;
                    // $review_check = Review::where('user_id', Auth::id())->where('product_id', $product_id)->first();
                    $verifikasi_pembelian = Order::where('orders.user_id', Auth::id())
                            ->join('order_items', 'orders.id', 'order_items.order_id')
                            ->where('order_items.product_id', $product_id)->get();
                }
                if($ratings->count() > 0){
                    $rating_value = $rating_sum/$ratings->count();
                } else{
                    $rating_value =0;
                }
                $judulhalaman = $product->name;
                return view('frontend.products.view', compact(['judulhalaman', 'product', 'ratings', 'rating_value', 'user_rating', 'verifikasi_pembelian','reviews']));
            } else{
                $pesan = "Tautan Rusak";
                return redirect('/')->with('warning', $pesan);
            }
        } else {
            $pesan = "Tidak ada category yang ditemukan";
            return redirect('/')->with('warning', $pesan);
        }
    }
}
