<?php

namespace App\Http\Controllers;

use App\Notifications\Colloquium\Status;
use App\Training;
use App\Colloquium;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Colloquium\StoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ColloquiaController extends Controller
{
    /**
     * Display all colloquia on the television.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        Notification::send(false, new Status());

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
        $attributes = $request->all();

        // Before we store any colloquia, we must check who posted it.
        // In case a `planner` or `administrator` posted it, the status is `accepted` by default.
        // Any other case the status is `awaiting` for the planner to accept  it.
        if (Auth::check() && $request->user()->can('review', Colloquium::class)) {
            $attributes['status'] = Colloquium::ACCEPTED;
        } else {
            $attributes['status'] = Colloquium::AWAITING;
        }

        $colloquium = Colloquium::create($attributes);

        // Send an e-mail to all planners who are subscribed to the given training.
        if ($attributes['status'] == Colloquium::AWAITING) {
            $colloquium->token = str_random(10);
            $colloquium->save();

            Notification::send(false, new Status($attributes['email']));
        }

        return redirect()
                ->route('colloquia.index')
                ->with('success', 'Colloquium toegevoegd.');
    }
}
