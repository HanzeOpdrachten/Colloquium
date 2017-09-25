@extends('layouts.app')

@section('content')
<div class="starter-template">
  <h1>Colloquia</h1>

  <div class="col-xs-12 col-sm-12">

  @auth
    @if(Auth::user()->isAdmin() || Auth::user()->isPlanner())
      @include('layouts.alerts')
      <a href="{{ route('colloquia.create') }}" class="btn btn-primary float-right">Colloquium toevoegen</a>
    @endif
  @endauth

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
      </tr>
    </thead>
    <tbody>
    @foreach($colloquia as $colloquium)
      <tr>
        <td>
          <span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span>
        </td>
        <td>{{ $colloquium->title }}</td>
        <td>{{ $colloquium->speaker }}</td>
        <td>{{ $colloquium->location }}</td>
        <td>{{ $colloquium->description }}</td>
        <td>{{ $colloquium->start_date->format('d-m-Y H:s') }}</td>
        <td>{{ $colloquium->language }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </div>
</div>

@endsection
