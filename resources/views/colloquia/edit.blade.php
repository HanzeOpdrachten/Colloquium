@extends('layouts.app')

@section('title', 'Edit: ' . $colloquium->title)

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Colloquia' => route('colloquia.index'),
      'Edit: ' . $colloquium->title => '#'
    ]
  ])
@endsection

@section('content')
  <div class="container">
    @include('layouts.alerts')
    <div class="col-md-6">
      <form method="post" action="{{ route('colloquia.update', $colloquium->id) }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="title">Titel</label>
          <input type="text" class="form__input {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" value="{{ $colloquium->title }}">
          @if ($errors->has('title'))
            <div class="invalid-feedback">
              {{ $errors->first('title') }}
            </div>
          @endif
        </div>
        <div class="form-group">
          <label for="training">Opleiding</label>
          <select class="form__input {{ $errors->has('training') ? 'is-invalid' : '' }}" name="training_id" id="training">
            @foreach($trainings as $training)
              @if ($colloquium->training->id == $training->id)
                <option value="{{ $training->id }}" selected>{{ $training->name }}</option>
              @else
                <option value="{{ $training->id }}">{{ $training->name }}</option>
              @endif
            @endforeach
          </select>
          @if ($errors->has('training'))
            <div class="invalid-feedback">
              {{ $errors->first('training') }}
            </div>
          @endif
        </div>
        <div class="form-group">
          <label for="speaker">Spreker</label>
          <input type="text" class="form__input {{ $errors->has('speaker') ? 'is-invalid' : '' }}" name="speaker" id="speaker" value="{{ $colloquium->speaker }}">
          @if ($errors->has('speaker'))
            <div class="invalid-feedback">
              {{ $errors->first('speaker') }}
            </div>
          @endif
        </div>

        @guest
          <div class="form-group">
            <label for="email">E-mailadres</label>
            <input type="text" class="form__input {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ $colloquium->email }}">
            @if ($errors->has('email'))
              <div class="invalid-feedback">
                {{ $errors->first('email') }}
              </div>
            @endif
          </div>
        @endguest

        <div class="form-group">
          <label for="location">Locatie</label>
          <input type="text" class="form__input {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location" value="{{ $colloquium->location }}">
          @if ($errors->has('location'))
            <div class="invalid-feedback">
              {{ $errors->first('location') }}
            </div>
          @endif
        </div>
        <div class="form-group">
          <label for="description">Omschrijving</label>
          <textarea class="form__input" name="description" id="description" style="min-height:100px; max-height:200px;">{{ $colloquium->description }}</textarea>
          @if ($errors->has('description'))
            <div class="invalid-feedback">
              {{ $errors->first('description') }}
            </div>
          @endif
        </div>
        <div class="form-group">
          <label for="language">Taal</label>
          <input type="text" class="form__input {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language" id="language" value="{{ $colloquium->language }}">
          @if ($errors->has('language'))
            <div class="invalid-feedback">
              {{ $errors->first('language') }}
            </div>
          @endif
        </div>
        <div class="form-group">
          <label for="start-date">Startdatum</label>
          <input class="form__input {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="datetime-local" name="start_date" id="start-date" value="{{ $colloquium->start_date->format('d-m-Y H:s') }}">
          @if ($errors->has('start_date'))
            <div class="invalid-feedback">
              {{ $errors->first('start_date') }}
            </div>
          @endif
        </div>
        <div class="form-group">
          <label for="end-date">Einddatum</label>
          <input class="form__input {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="datetime-local" name="end_date" id="end-date" value="{{ $colloquium->end_date->format('d-m-Y H:i') }}">
          @if ($errors->has('end_date'))
            <div class="invalid-feedback">
              {{ $errors->first('end_date') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          <div class="float-right">
            <button type="submit" class="button button--primary">Opslaan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
