@extends('layouts.app')

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
          <td>{{ $colloquium->start_date->format('d-m-Y H:i') }} ({{ $colloquium->start_date->diffForHumans() }})</td>
        </tr>
        <tr>
          <th scope="row"><i class="fa fa-clock-o"></i> Duur</th>
          <td>{{ gmdate('H:i', \Carbon\Carbon::parse($colloquium->end_date)->diffInSeconds($colloquium->start_date)) }}</td>
        </tr>
        <tr>
          <th scope="row" width="15%;"><i class="fa fa-language"></i> Taal</th>
          <td>{{ $colloquium->language }}</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
