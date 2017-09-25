<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Colloquium;
use App\User;
use App\Training;
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
        $colloquia = Colloquium::oldest('start_date')->get();
        return view('colloquia.index', compact('colloquia'));
    }

    public function create()
    {
      $speakers = User::where('role', '=', 2)->get();
      $trainings = Training::all();

      $this->authorize('create', Colloquium::class);
      return view('colloquia.create', compact('speakers', 'trainings'));
    }

    public function store(StoreRequest $request)
    {
      Colloquium::create($request->all());

      return redirect()
             ->route('colloquia.index')
             ->with('succes', 'Colloquium toegevoegd.');
    }
}
