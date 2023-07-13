<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $judulhalaman = "Pesanan Saya";
        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.orders.index', compact(['judulhalaman', 'orders']));
    } 
    
    public function view($id){
        $judulhalaman = "Detail Pesanan Saya";
        $orders = Order::where('id', $id)->where('user_id', Auth::id())->first();
        return view('frontend.orders.view', compact(['judulhalaman', 'orders']));
    }

    public function pesanancount(){
        $pesanancount = Order::where('user_id', Auth::id())->count();
        return response()->json(['count' => $pesanancount]);
    }
}
