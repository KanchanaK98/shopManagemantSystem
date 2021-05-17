<?php

namespace App\Http\Controllers;
use App\Models\Hardware;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data=Hardware::all();

        return view('hardwareView')->with('datas',$data);
    }
}
