<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function users(){
        $judulhalaman = "Pengguna Terdaftar";
        $users = User::paginate(10);
        return view('admin.users.index', compact(['judulhalaman', 'users']));
    }
    public function viewUsers($id){
        $judulhalaman = "Detail Pengguna";
        $users = User::find($id);
        return view('admin.users.view', compact(['judulhalaman', 'users']));
    }
}
