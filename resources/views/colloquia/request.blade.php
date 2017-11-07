@extends('layouts.app')

@section('title', 'Request')

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Request colloquia' => '#'
    ]
  ])
@endsection

@section('content')
  @include('layouts.alerts')

  <div class="box column column--whole">
    <div class="row">
      <form method="post" class="form" action="{{ route('colloquia.request.store') }}">
        @include('colloquia.form')
      </form>
    </div>
  </div>
  @include('layouts.footer')
@endsection
