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
     * Display all
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $colloquia = Colloquium::orderBy('status', Colloquium::AWAITING, 'asc')->get();

        return view('colloquia.index', compact('colloquia'));
    }

    /**
     * Display a specific colloquium.
     *
     * @param Colloquium $colloquium
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Colloquium $colloquium)
    {
      return view('colloquia.show', compact('colloquium'));
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
        $attributes = $request->all();
        $attributes['training_id'] = $request->get('training');

        $startDate = $request->get('date');
        $startTime = $request->get('start_time');
        $endTime = $request->get('end_time');
        $startDateTime = date('Y-m-d H:i:s', strtotime("$startDate $startTime"));
        $endDateTime = date('Y-m-d H:i:s', strtotime("$startDate $endTime"));

        $attributes['start_date'] = $startDateTime;
        $attributes['end_date'] = $endDateTime;

        unset($attributes['start_time']);
        unset($attributes['end_time']);
        unset($attributes['training']);
        unset($attributes['date']);

        $colloquium = Colloquium::create($attributes);

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Colloquium $colloquium)
    {
        $this->authorize('update', Colloquium::class);

        $trainings = Training::all();
        $statuses = [
            Colloquium::AWAITING => 'Wachten op goedkeuring',
            Colloquium::ACCEPTED => 'Goedgekeurd',
            Colloquium::DECLINED => 'Geweigerd',
        ];

        return view('colloquia.edit', compact('colloquium', 'trainings', 'statuses'));
    }

    /**
     * Display the edit form for the speaker.
     *
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage($token)
    {
        // Find colloquium by token.
        $colloquium = Colloquium::where('token', '=', $token)->first();

        // Requested colloquium doesn't exist.
        // Show 404 page.
        if ($colloquium === null) {
            return abort(404);
        }

        $trainings = Training::all();

        return view('colloquia.edit', compact('colloquium', 'trainings'));
    }

    /**
     * Accept a colloquium.
     *
     * @param Colloquium $colloquium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Colloquium $colloquium)
    {
        $this->authorize('accept', $colloquium);

        $colloquium->status = Colloquium::ACCEPTED;
        $colloquium->save();

        return redirect()
            ->route('home')
            ->with('success', 'Colloquium is succesvol goedgekeurd. Het colloquium is nu voor iedereen zichtbaar in het overzicht.');
    }

    /**
     * Decline a colloquium.
     *
     * @param Colloquium $colloquium
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline(Colloquium $colloquium, UpdateRequest $request)
    {
      $colloquium->status = Colloquium::DECLINED;
      $colloquium->save();

      return redirect()
          ->route('home')
          ->with('success', 'Colloquium is succesvol geweigerd. Het colloquium is nu niet zichtbaar in het overzicht.');
    }

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Colloquium $colloquium
	 *
     * @return \Illuminate\Http\Response
     */
    public function update(Colloquium $colloquium, UpdateRequest $request)
    {
		$colloquium->fill($request->all())
			->save();

		return redirect()
			->route('colloquia.show', $colloquium->id)
			->with('success', 'The colloquium has been edited.');
    }
}
