@extends('layouts.app', ['noHeader' => true])

@section('content')
  <div class="column column--two-third">
    @foreach($colloquia as $colloquium)
      <div class="lecture">
        <div class="lecture__date-time">
          <span class="lecture__day">{{ date('j', strtotime($colloquium->start_date)) }}</span>
          <span class="lecture__month">{{ date('M', strtotime($colloquium->start_date)) }}</span>
        </div>
        <div class="lecture__content">
          <h2 class="lecture__title">{{ $colloquium->title }}</h2>
          <p class="lecture__description">{{ $colloquium->description }}</p>
          <span class="lecture__course">{{ $colloquium->training->name }}</span>
        </div>
        <span class="lecture__language">{{ $colloquium->language }}</span>
        <span class="lecture__time">{{ date('G:i', strtotime($colloquium->start_date)) }} - {{ date('G:i', strtotime($colloquium->end_date)) }}</span>
        <div class="lecture__location">
          {{ $colloquium->location }}
        </div>
      </div>
    @endforeach
  </div>

  <div class="column column--one-third column--last">
        <h1>TV Sub content QR scanner oid?</h1>
  </div>


@endsection