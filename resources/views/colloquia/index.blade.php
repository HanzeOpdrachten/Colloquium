@extends('layouts.app')

@section('content')
<div class="starter-template">
  <h1>Colloquia</h1>

  <table class="table">
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
        <td>{{ $colloquium->start_date }}</td>
        <td>{{ $colloquium->language }}</td>
        <td><span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span></th>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

@endsection
