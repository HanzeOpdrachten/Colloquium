@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.alerts')
        <div class="col-md-6">
            <form method="post" action="{{ route('colloquia.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" >
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="role">Opleiding</label>
                    <select class="form-control {{ $errors->has('training') ? 'is-invalid' : '' }}" name="training_id">
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
                    <label for="role">Spreker</label>
                    <select class="form-control {{ $errors->has('speaker') ? 'is-invalid' : '' }}" name="speaker">
                        @foreach($speakers as $speaker)
                            @if (old('speaker') == $speaker)
                                <option value="{{ $speaker->id }}" selected>{{ $speaker->name }}</option>
                            @else
                                <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('speaker'))
                        <div class="invalid-feedback">
                            {{ $errors->first('speaker') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="location">Locatie</label>
                    <input type="text" class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location">
                    @if ($errors->has('location'))
                        <div class="invalid-feedback">
                            {{ $errors->first('location') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Omschrijving</label>
                    <input type="text" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="role">Taal</label>
                    <select class="form-control {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language">
                      <option value="Nederlands" selected>Nederlands</option>
                      <option class="Engels">Engels</option>
                    </select>
                    @if ($errors->has('language'))
                        <div class="invalid-feedback">
                            {{ $errors->first('language') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                  <label for="start_date">Datum</label>
                  <input class="form-control {{ $errors->has('language') ? 'is-invalid' : '' }}" type="date" name="start_date">
                </div>

                <div class="form-group">
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
