<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Colloquium;

class ColloquiaController extends Controller
{
    public function index()
    {
      $colloquia = Colloquium::oldest('start_date')->get();
      return view('colloquia.index', compact('colloquia'));
    }
}
