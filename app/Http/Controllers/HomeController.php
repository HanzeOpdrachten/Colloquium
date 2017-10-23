<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ColloquiaController;
use App\Colloquium;

class HomeController extends Controller
{
    /**
     * Display all colloquia for the desktop.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $colloquia = Colloquium::oldest('start_date')
            ->where('status', '=', Colloquium::ACCEPTED)
            ->get();

        return view('home', compact('colloquia'));
    }

    /**
     * Display all colloquia for the television.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tv()
    {
        $colloquia = Colloquium::oldest('start_date')
            ->where('status', '=', Colloquium::ACCEPTED)
            ->get();

        return view('tv', compact('colloquia'));
    }
}
