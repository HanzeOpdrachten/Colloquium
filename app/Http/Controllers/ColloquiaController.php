<?php

namespace App\Http\Controllers;

use App\Training;
use Carbon\Carbon;
use App\Colloquium;
use App\Notifications\Colloquium\Status;
use App\Notifications\Colloquium\Review;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Colloquium\StoreRequest;
use App\Http\Requests\Colloquium\UpdateRequest;

class ColloquiaController extends Controller
{
    /**
     * Display all colloquia.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $colloquia = Colloquium::orderBy('status', 'asc')->get();

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
     * @param Colloquium $colloquium
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Colloquium $colloquium)
    {
        $this->authorize('create', Colloquium::class);

        $trainings = Training::all();
        $statuses = [
            Colloquium::AWAITING => 'Waiting for acceptance',
            Colloquium::ACCEPTED => 'Accepted',
            Colloquium::DECLINED => 'Declined',
            Colloquium::CANCELED => 'Canceled',
        ];

        return view('colloquia.create', compact('colloquium', 'trainings', 'statuses'));
    }

    /**
     * Display the form requesting a colloquium.
     *
     * @param Colloquium $colloquium
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createRequest(Colloquium $colloquium)
    {
        $trainings = Training::all();

        return view('colloquia.request', compact('colloquium', 'trainings'));
    }

    /**
     * Store a requested colloquium for review en send en e-mail to the speaker.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRequest(StoreRequest $request)
    {
        $attributes = $request->all();

        $attributes['start_date']   = $attributes['date'].' '.$attributes['start_time'].':00';
        $attributes['end_date']     = $attributes['date'].' '.$attributes['end_time'].':00';
        $attributes['start_date']   = Carbon::createFromFormat('Y-m-d H:i:s', $attributes['start_date'])->toDateTimeString();
        $attributes['end_date']     = Carbon::createFromFormat('Y-m-d H:i:s', $attributes['end_date'])->toDateTimeString();

        $colloquium = Colloquium::create($attributes);
        $colloquium->setToken();

        Notification::send($colloquium->planners, new Review($colloquium));

        $colloquium->notify(new Status($colloquium));

        return redirect()
            ->route('home')
            ->with('success', 'The colloquium has been submitted and is awaiting for a review. We\'ve send you an e-mail with more details.');
    }

    /**
     * Display the edit form for the speaker.
     *
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editRequest($token)
    {
        $colloquium = Colloquium::where('token', '=', $token)->firstOrFail();
        $trainings = Training::all();
        $statuses = [
            Colloquium::AWAITING => 'Waiting for acceptance',
            Colloquium::ACCEPTED => 'Accepted',
            Colloquium::DECLINED => 'Declined',
            Colloquium::CANCELED => 'Canceled',
        ];

        return view('colloquia.editRequest', compact('colloquium', 'trainings', 'statuses'));
    }

    /**
     * Update the requested colloquium.
     *
     * @param StoreRequest $request
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRequest(StoreRequest $request, $token)
    {
        $colloquium = Colloquium::where('token', '=', $token)->firstOrFail();

        $attributes = $request->all();
        $attributes['start_date'] = $attributes['date'].' '.$attributes['start_time'];
        $attributes['end_date'] = $attributes['date'].' '.$attributes['end_time'];
        $attributes['start_date'] = Carbon::createFromFormat('Y-m-d H:i', $attributes['start_date'])->toDateTimeString();
        $attributes['end_date'] = Carbon::createFromFormat('Y-m-d H:i', $attributes['end_date'])->toDateTimeString();
        $attributes['status'] = Colloquium::AWAITING;
        $attributes['changed'] = ($colloquium->isAccepted()) ? true : false;

        $colloquium->fill($attributes);
        $colloquium->save();
        $colloquium->notify(new Status($colloquium));

        return redirect()
            ->back()
            ->with('success', 'The details of this colloquium are submitted and waiting for evaluation. Keep an eye on your mailbox.');
    }

    /**
     * Store a new resource.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
	    $this->authorize('create', Colloquium::class);

        $attributes = $request->all();
        $attributes['start_date'] = $attributes['date'].' '.$attributes['start_time'];
        $attributes['end_date'] = $attributes['date'].' '.$attributes['end_time'];
        $attributes['start_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $attributes['start_date'])->toDateTimeString();
        $attributes['end_date'] = Carbon::createFromFormat('Y-m-d H:i:s', $attributes['end_date'])->toDateTimeString();

        Colloquium::create($attributes);

        return redirect()
            ->route('colloquia.index')
            ->with('success', 'The colloquium has been added.');
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
            Colloquium::AWAITING => 'Waiting for acceptance',
            Colloquium::ACCEPTED => 'Accepted',
            Colloquium::DECLINED => 'Declined',
            Colloquium::CANCELED => 'Canceled',
        ];

        return view('colloquia.edit', compact('colloquium', 'trainings', 'statuses'));
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
            ->route('colloquia.index')
            ->with('success', 'The colloquium has succesfully been accepted. It will now be visible in the overview for everyone.');
    }

    /**
     * Decline a colloquium.
     *
     * @param Colloquium $colloquium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline(Colloquium $colloquium)
    {
      $colloquium->status = Colloquium::DECLINED;
      $colloquium->save();

      return redirect()
          ->route('colloquia.index')
          ->with('success', 'The colloquium has been rejected. It will not be visible any longer in the overview.');
    }

	/**
     * Update the specified resource in storage.
     *
     * @param  Colloquium $colloquium
     * @param  UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Colloquium $colloquium, UpdateRequest $request)
    {
		$colloquium->fill($request->all());
        $colloquium->changed = true;
        $colloquium->save();

		return redirect()
			->route('colloquia.show', $colloquium->id)
            ->with('success', 'The colloquium has been edited. This will now be visible in the overview.');
    }

    /**
     * Delete specified resource.
     *
     * @param Colloquium $colloquium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Colloquium $colloquium)
    {
        $colloquium->delete();

        return redirect()
            ->route('colloquia.index')
            ->with('success', 'The colloquium has been removed.');
    }
}
