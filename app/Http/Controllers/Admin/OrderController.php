<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class OrderController extends Controller
{
    public function index(){
        $judulhalaman ="Pesanan Baru";
        $orders = Order::where('status', '0')->paginate(5);
        return view('admin.orders.index', compact(['judulhalaman', 'orders']));
    }

    public function viewOrder($id){
        $judulhalaman = "Detail Pesanan";
        $orders = Order::where('id', $id)->first();
        return view('admin.orders.viewOrder', compact(['judulhalaman', 'orders']));
    }

    public function updateOrder(Request $request, $id){
        $pesan = "Berhasil Update Status Order";
        $orders = Order::find($id);
        $orders->status = $request->order_status;
        $orders->update();
        return redirect('orders')->with('success', $pesan);
    }

    public function orderHistory(){
        $judulhalaman ="Riwayat Pesanan";
        $orders = Order::where('status', '1')->paginate(5);
        return view('admin.orders.historyOrder', compact(['judulhalaman', 'orders']));
    }
}
