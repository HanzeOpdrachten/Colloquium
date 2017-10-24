@extends('layouts.app')

@section('content')
    <div class="column column--whole">
        @include('layouts.alerts')
    </div>

    <div class="column column--whole">
        <div class="row">
            <form method="post" class="form" action="{{ route('colloquia.request.store') }}">
                @include('colloquia.form')
            </form>
        </div>
    </div>
    @include('layouts.footer')
@endsection
