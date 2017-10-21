<?php

namespace App\Http\Controllers;

use App\Http\Requests\Training\StoreRequest;
use App\Http\Requests\Training\UpdateRequest;
use App\Training;
use App\User;
use App\Colloquium;
use Illuminate\Http\Request;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Training::class);

        $trainings = Training::all();

        return view('trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Training::class);

        return view('trainings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $training = Training::create($request->all());

        return redirect()
            ->route('trainings.index')
            ->with('success', 'De opleiding is toegevoegd.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Training $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Training $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        return view('trainings.edit', compact('training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  Training $training
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Training $training)
    {
        $training->fill($request->all());
        $training->save();

        return redirect()
            ->route('trainings.index')
            ->with('success', 'Opleiding bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Training $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        $this->authorize('delete', $training);

        $colloquia = Colloquium::where('training_id', $training->id)
            ->update(['training_id' => 1]);

        $training->delete();

        return redirect()
            ->route('trainings.index')
            ->with('success', 'Opleiding verwijdert.');
    }

    /**
     * Subscribe a planner to a training.
     *
     * @param Training $training
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Training $training, Request $request)
    {
        $user = $request->user();
        $training->subscribers()->toggle($user->id);

        return redirect()
            ->route('trainings.index');
    }

    /**
     * Unsubscribe a planner from a training.
     *
     * @param Training $training
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe(Training $training, Request $request)
    {
        $user = $request->user();
        $training->subscribers()->toggle($user->id);

        return redirect()
            ->route('trainings.index');
    }
}
