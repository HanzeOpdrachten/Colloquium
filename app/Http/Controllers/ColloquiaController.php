<?php

namespace App\Http\Controllers;

use App\Colloquium;
use Illuminate\Http\Request;

class ColloquiaController extends Controller
{
    /**
     * Display all colloquia on the television.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', Colloquium::class);

        $colloquia = Colloquium::oldest('start_date')->get();

        return view('colloquia.index', compact('colloquia'));
    }
}
