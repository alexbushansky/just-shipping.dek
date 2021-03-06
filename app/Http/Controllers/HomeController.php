<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Mockery\Container;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return redirect()->route('users.show',['user'=>auth()->user()->id]);
    }
}
