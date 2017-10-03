<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ColloquiaController;
use App\Colloquium;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $colloquia = Colloquium::oldest('start_date')
          ->where('status', '=', Colloquium::AWAITING)
          ->get();

        return view('home', compact('colloquia'));
    }
}
