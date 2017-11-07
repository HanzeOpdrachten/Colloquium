@extends('layouts.app')

@section('content')
  @include('layouts.alerts')

  <div class="column column--whole">
    <div class="row">
      <p>Here you may edit the details of this colloquium. Note: every modification requires the item to be reviewed again.</p>
      <p>Current status:
        @if ($colloquium->status == \App\Colloquium::AWAITING)
          <button class="btn btn--primary" disabled>Awaiting</button>
        @elseif ($colloquium->status == \App\Colloquium::ACCEPTED)
          <button class="btn btn--primary" disabled>Accepted</button>
        @elseif ($colloquium->status == \App\Colloquium::DECLINED)
          <button class="btn btn--primary" disabled>Declined</button>
        @elseif ($colloquium->status == \App\Colloquium::CANCELED)
          <button class="btn btn--primary" disabled>Canceled</button>
        @endif
      </p>
    </div>
    <div class="row">
      <form method="post" class="form" action="{{ route('colloquia.request.update', $colloquium->token) }}">
        {{ method_field('PATCH') }}
        @include('colloquia.form')
      </form>
    </div>
  </div>
  @include('layouts.footer')
@endsection
