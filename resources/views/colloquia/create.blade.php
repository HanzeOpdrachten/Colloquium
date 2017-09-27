@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.alerts')
        <div class="col-md-6">
            <form method="post" action="{{ route('colloquia.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="training">Opleiding</label>
                    <select class="form-control {{ $errors->has('training') ? 'is-invalid' : '' }}" name="training_id" id="training" value="{{ old('training') }}">
                        @foreach($trainings as $training)
                            @if (old('training') == $training)
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
                    <input type="text" class="form-control {{ $errors->has('speaker') ? 'is-invalid' : '' }}" name="speaker" id="speaker" value="{{ old('speaker') }}">
                    @if ($errors->has('speaker'))
                        <div class="invalid-feedback">
                            {{ $errors->first('speaker') }}
                        </div>
                    @endif
                </div>

                @guest
                    <div class="form-group">
                        <label for="email">E-mailadres</label>
                        <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                @endguest

                <div class="form-group">
                    <label for="location">Locatie</label>
                    <input type="text" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location" value="{{ old('location') }}">
                    @if ($errors->has('location'))
                        <div class="invalid-feedback">
                            {{ $errors->first('location') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Omschrijving</label>
                    <textarea class="form-control" name="description" id="description" style="min-height:100px; max-height:200px;">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="language">Taal</label>
                    <input type="text" class="form-control {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language" id="language" value="{{ old('language') }}">
                    @if ($errors->has('language'))
                        <div class="invalid-feedback">
                            {{ $errors->first('language') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                  <label for="start-date">Startdatum</label>
                  <input class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="datetime-local" name="start_date" id="start-date" value="{{ old('start_date') }}">
                  @if ($errors->has('start_date'))
                      <div class="invalid-feedback">
                          {{ $errors->first('start_date') }}
                      </div>
                  @endif
                </div>
                <div class="form-group">
                    <label for="end-date">Einddatum</label>
                    <input class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="datetime-local" name="end_date" id="end-date" value="{{ old('end_date') }}">
                    @if ($errors->has('end_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </div>
                    @endif
                </div>

                @auth
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status">
                            @foreach($statuses as $key => $value)
                                @if ($key == old('status'))
                                    <option value="{{ $key }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <div class="invalid-feedback">
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                    </div>
                @endauth

                <div class="form-group">
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
