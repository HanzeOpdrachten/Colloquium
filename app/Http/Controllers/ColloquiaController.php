<?php

namespace App\Http\Controllers;

use App\Training;
use App\Colloquium;
use Illuminate\Http\Request;
use App\Http\Requests\Colloquium\StoreRequest;

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

    /**
     * Display the form for creation.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Colloquium::class);

        $trainings = Training::all();

        return view('colloquia.create', compact('trainings'));
    }

    public function request()
    {
        $trainings = Training::all();

        return view('colloquia.create', compact('trainings'));
    }

    /**
     * Store a new resource.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        Colloquium::create($request->all());

        return redirect()
                ->route('colloquia.index')
                ->with('success', 'Colloquium toegevoegd.');
    }
}
