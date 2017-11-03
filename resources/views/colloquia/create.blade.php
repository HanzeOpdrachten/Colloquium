@extends('layouts.app')

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Colloquia' => route('colloquia.index'),
      'Add colloquia' => '#'
    ]
  ])
@endsection

@section('content')

  @include('layouts.alerts')

  <div class="box column column--whole">
    <div class="row">
      <form method="post" class="form" action="{{ route('colloquia.store') }}">
        @include('colloquia.form')
      </form>
    </div>
  </div>
  @include('layouts.footer')
@endsection
