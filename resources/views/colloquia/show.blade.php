@extends('layouts.app')

@section('title', $colloquium->title)

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Colloquia' => route('colloquia.index'),
      $colloquium->title => '#'
    ]
  ])
@endsection

@section('content')
  <div class="box column column--whole">
    <h1 class="box__title">{{  $colloquium->title }}</h1>
    <p class="box__content">{{ $colloquium->description }}</p>
  </div>

  <div class="column column--whole">
    <table class="table table-bordered table-responsive">
      <tbody>
        <tr>
          <th scope="row"><i class="fa fa-graduation-cap"></i> Training</th>
          <td><span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span></td>
        </tr>
        <tr>
          <th scope="row" width="15%;"><i class="fa fa-user"></i> Speaker</th>
          <td>{{ $colloquium->speaker }}</td>
        </tr>
        <tr>
          <th scope="row"><i class="fa fa-building"></i> Location</th>
          <td>{{ $colloquium->location }}</td>
        </tr>
        <tr>
          <th scope="row"><i class="fa fa-calendar-o"></i> Date</th>
          <td>{{ $colloquium->start_date->format('d-m-Y H:i') }} ({{ $colloquium->start_date->diffForHumans() }})</td>
        </tr>
        <tr>
          <th scope="row"><i class="fa fa-clock-o"></i> Length (hours)</th>
          <td>{{ gmdate('H:i', \Carbon\Carbon::parse($colloquium->end_date)->diffInSeconds($colloquium->start_date)) }}</td>
        </tr>
        <tr>
          <th scope="row" width="15%;"><i class="fa fa-language"></i> Language</th>
          <td>{{ $colloquium->language }}</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
