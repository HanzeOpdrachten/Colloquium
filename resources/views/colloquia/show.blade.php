@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="starter-template center">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{  $colloquium->title }}</h4>
          <h6 class="card-subtitle mb-2" style="color: {{ $colloquium->training->color }};">{{  $colloquium->training->name }}</h6>

          <p>{{ $colloquium->description }}</p>

          <table class="table table-bordered table-responsive">
            <tbody>
              <tr>
                <th scope="row" width="15%;"><i class="fa fa-user"></i> Spreker</th>
                <td>{{ $colloquium->speaker }}</td>
              </tr>
              <tr>
                <th scope="row"><i class="fa fa-graduation-cap"></i> Opleiding</th>
                <td><span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span></td>
              </tr>
              <tr>
                <th scope="row"><i class="fa fa-building"></i> Locatie</th>
                <td>{{ $colloquium->location }}</td>
              </tr>
              <tr>
                <th scope="row"><i class="fa fa-calendar-o"></i> Begint op</th>
                <td>{{ $colloquium->start_date }} ({{ $colloquium->start_date->diffForHumans() }})</td>
              </tr>
              <tr>
                <th scope="row"><i class="fa fa-calendar-o"></i> Eindigt op</th>
                <td>{{ $colloquium->end_date }}</td>
              </tr>
              <tr>
                <th scope="row" width="15%;"><i class="fa fa-language"></i> Taal</th>
                <td>{{ $colloquium->language }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
