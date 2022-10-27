<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $role = auth()->user()->role;

        if($role == 'user'){
            return redirect()->route('users.profile'); 
        }
        else{
            return redirect()->route('users.index');        }

    }
}
