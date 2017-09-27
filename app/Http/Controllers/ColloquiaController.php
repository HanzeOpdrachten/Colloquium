<?php

namespace App\Http\Controllers;

use App\Training;
use App\Colloquium;
use App\Notifications\Colloquium\Status;
use App\Http\Requests\Colloquium\StoreRequest;
use App\Http\Requests\Colloquium\UpdateRequest;

class ColloquiaController extends Controller
{
    /**
     * Display all colloquia on the television.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $colloquia = Colloquium::oldest('start_date')
            ->where('status', '=', Colloquium::ACCEPTED)
            ->get();

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
        $statuses = [
            Colloquium::AWAITING => 'Wachten op goedkeuring',
            Colloquium::ACCEPTED => 'Goedgekeurd',
            Colloquium::DECLINED => 'Geweigerd',
        ];

        return view('colloquia.create', compact('trainings', 'statuses'));
    }

    /**
     * Store a new resource.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $colloquium = Colloquium::create($request->all());

        // Resync the data from the database because a few attributes are default in de database
        // but not in Eloquent. So Eloquent will not retrieve them right away.
        // For that we have to retrieve the record from the database.
        $colloquium = $colloquium->fresh();

        // Send an e-mail to all planners who are subscribed to the given training.
        if ($colloquium->status == Colloquium::AWAITING) {
            // Set a token
            $colloquium->setToken();

            // Send an e-mail to the speaker
            $colloquium->notify(new Status($colloquium));

            return redirect()
                ->route('colloquia.index')
                ->with('success', 'Colloquium is aangemaakt en wacht op goedkeuring. Je hebt een e-mail ontvangen met een link waarmee je de status kunt bijhouden.');
        }

        return redirect()
                ->route('colloquia.index')
                ->with('success', 'Colloquium toegevoegd.');
    }

    /**
     * Display the edit form for the resource.
     *
     * @param Colloquium $colloquium
     * @param UpdateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Colloquium $colloquium, UpdateRequest $request)
    {
        $trainings = Training::all();
        $statuses = [
            Colloquium::AWAITING => 'Wachten op goedkeuring',
            Colloquium::ACCEPTED => 'Goedgekeurd',
            Colloquium::DECLINED => 'Geweigerd',
        ];

        return view('colloquia.edit', compact('colloquium', 'trainings', 'statuses'));
    }
}
