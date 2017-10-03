@extends('layouts.app')

@section('content')
<div class="starter-template">
  <h1>Dashboard</h1>
  <p>Welkom terug, {{ Auth::user()->name }}.</p>
  @include('layouts.alerts')
  @auth
    @if(Auth::user()->isAdmin() || Auth::user()->isPlanner())
      @if (!$colloquia->isEmpty())
        <div class="col-xs-12 col-sm-12">
          <p>Hieronder is een overzicht te vinden met daarin colloquia die wachten op goedkeuring.</p>

          <table class="table table-responsive">
            <thead class="thead-inverse">
              <tr>
                <th>Training</th>
                <th>Title</th>
                <th>Speaker</th>
                <th>Location</th>
                <th>Description</th>
                <th>Date</th>
                <th>Language</th>
                <th>Acties</th>
              </tr>
            </thead>
            <tbody>
            @foreach($colloquia as $colloquium)
              <tr>
                <td>
                  <span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span>
                </td>
                <td><a href="{{ route('colloquia.show', $colloquium->id) }}">{{ $colloquium->title }}</a></td>
                <td>{{ $colloquium->speaker }}</td>
                <td>{{ $colloquium->location }}</td>
                <td>{{ $colloquium->description }}</td>
                <td>{{ $colloquium->start_date->format('d-m-Y H:s') }}</td>
                <td>{{ $colloquium->language }}</td>
                <td>
                  <a href="{{ route('colloquia.accept', $colloquium->id) }}" class="btn btn-primary">Accepteren</a>
                  <a href="{{ route('colloquia.decline', $colloquium->id) }}" class="btn btn-danger">Weigeren</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p>Er zijn op dit moment geen colloquia die goedgekeurd/afgekeurd kunnen worden.</p>
      @endif
    @endif
  @endauth
</div>
