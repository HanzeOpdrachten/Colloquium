@extends('layouts.app')

@section('content')
<div class="starter-template">
  <h1>Colloquia</h1>

  <div class="col-xs-12 col-sm-12">
  <table class="table table-responsive">
    <thead class="thead-inverse">
      <tr>
        <th>Title</th>
        <th>Speaker</th>
        <th>Location</th>
        <th>Description</th>
        <th>Date</th>
        <th>Language</th>
        <th>Training</th>
      </tr>
    </thead>
    <tbody>
    @foreach($colloquia as $colloquium)
      <tr>
        <td>{{ $colloquium->title }}</td>
        <td>{{ $colloquium->speaker }}</td>
        <td>{{ $colloquium->location }}</td>
        <td>{{ $colloquium->description }}</td>
        <td>{{ $colloquium->start_date->format('d-m-Y H:s') }}</td>
        <td>{{ $colloquium->language }}</td>
        <td>
          <span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </div>
</div>

@endsection
