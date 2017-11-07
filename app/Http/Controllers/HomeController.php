<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ColloquiaController;
use App\Colloquium;
use App\Training;
use Carbon\Carbon;

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
            ->where('start_date','>',Carbon::today())
            ->get();

        return view('home', compact('colloquia'));
    }

    /**
     * Display all colloquia for the television.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tv(Training $training = null)
    {
        if (isset($training)) {
          $colloquia = $training->colloquia()
            ->where('status', '=', Colloquium::ACCEPTED)
            ->where('start_date','>',Carbon::today())
            ->get();
        } else {
          $colloquia = Colloquium::oldest('start_date')
              ->where('status', '=', Colloquium::ACCEPTED)
              ->where('start_date','>',Carbon::today())
              ->get();
        }

        return view('tv', compact('colloquia'));
    }
}
