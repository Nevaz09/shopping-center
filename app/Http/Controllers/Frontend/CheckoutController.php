<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $judulhalaman = "Checkout";
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        foreach($old_cartitems as $item){
            if(!Product::where('id', $item->product_id)->where('qty', '>=', $item->product_qty )->exists()){
                $removeItem = Cart::where('user_id', Auth::id())->where('product_id', $item->product_id)->first();
                $removeItem->delete();
            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact(['judulhalaman', 'cartitems']));
    }

    public function placeOrder(Request $request){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->email = $request->email;
        $order->no_telp = $request->no_telp;
        $order->alamat = $request->alamat;
        $order->kota = $request->kota;
        $order->provinsi = $request->provinsi;
        $order->negara = $request->negara;
        $order->kode_pos = $request->kode_pos;
        $order->payment_mode = $request->payment_mode;
        $order->payment_id = $request->payment_id;
        
        //total pesanan
        $total =0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartitems_total as $prod){
            $total += $prod->products->selling_price;
        }
        $order->total_price = $total;
        $order->tracking_no = 'amar'.rand(1111,9999);
        $order->save();
        $cartitems = Cart::where('user_id', Auth::id())->get();
        foreach($cartitems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->products->selling_price,
            ]);
            $prod = Product::where('id', $item->product_id)->first();
            $prod->qty = $prod->qty - $item->product_qty;
            $prod->update();
        }

        if(Auth::user()->alamat == Null){
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->fname;
            $user->last_name = $request->lname;
            $user->no_telp = $request->no_telp;
            $user->alamat = $request->alamat;
            $user->kota = $request->kota;
            $user->provinsi = $request->provinsi;
            $user->negara = $request->negara;
            $user->kode_pos = $request->kode_pos;
            $user->update();
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartitems);
        $pesan = "Berhasil Dipesan";
        if($request->payment_mode == "Pembayaran melalui Payment"){
            return response()->json(['status'=>'Berhasil melakukan pemesanan']);
        }
        return redirect('/')->with('status'.$pesan);
    }
    
    public function payment(Request $request){
        $cartitems = Cart::where('user_id', Auth::id())->get();
        $total = 0;
        foreach($cartitems as $item){
            $total += $item->products->selling_price * $item->product_qty;
        }

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $no_telp = $request->no_telp;
        $alamat = $request->alamat;
        $kota = $request->kota;
        $provinsi = $request->provinsi;
        $negara = $request->negara;
        $kode_pos = $request->kode_pos;

        return response()->json([
            'firstname'=> $firstname,
            'lastname'=> $lastname,
            'email'=> $email,
            'no_telp'=> $no_telp,
            'alamat'=> $alamat,
            'kota'=> $kota,
            'provinsi'=> $provinsi,
            'negara'=> $negara,
            'kode_pos'=> $kode_pos,
            'total'=> $total,
        ]);
    }
}