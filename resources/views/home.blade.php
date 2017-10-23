@extends('layouts.app')

@section('content')

  <div class="column column--whole">
    @auth
      @if(Auth::user()->isAdmin() || Auth::user()->isPlanner())
        @include('layouts.alerts')
        <a href="{{ route('colloquia.create') }}" class="button button--secondary button--right-float">Add colloquium</a>
      @endif
    @endauth
  </div>

  <div class="column column--whole">
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

@endsection
