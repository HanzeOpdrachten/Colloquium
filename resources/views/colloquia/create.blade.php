@extends('layouts.app')

@section('content')
    <div class="column column--whole">
        @include('layouts.alerts')
    </div>

    <div class="column column--whole">
        <div class="row">
            <form method="post" class="form" action="{{ route('colloquia.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="form__label" for="title">Onderwerp</label>
                    <input type="text" class="form__input {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="training">Gewenste opleiding voor dit colloquium</label>
                    <select class="form__input {{ $errors->has('training') ? 'is-invalid' : '' }}" name="training" id="training">
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
                    <label for="speaker">Naam van de spreker</label>
                    <input type="text" class="form__input {{ $errors->has('speaker') ? 'is-invalid' : '' }}" name="speaker" id="speaker" value="{{ old('speaker') }}">
                    @if ($errors->has('speaker'))
                        <div class="invalid-feedback">
                            {{ $errors->first('speaker') }}
                        </div>
                    @endif
                </div>

                @guest
                    <div class="form-group">
                        <label for="email">E-mailadres</label>
                        <input type="text" class="form__input {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                @endguest

                <div class="form-group">
                    <label for="location">Locatie van dit colloquium</label>
                    <input type="text" class="form__input {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location" value="{{ old('location') }}" placeholder="Bijv.: ZP09/D220">
                    @if ($errors->has('location'))
                        <div class="invalid-feedback">
                            {{ $errors->first('location') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Korte omschrijving</label>
                    <textarea class="form__input {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" style="min-height:100px; max-height:200px;">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="language">Gesproken taal</label>
                    <input type="text" class="form__input {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language" id="language" value="{{ old('language') }}">
                    @if ($errors->has('language'))
                        <div class="invalid-feedback">
                            {{ $errors->first('language') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="date">Datum</label>
                    <input class="form__input {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date" id="date" value="{{ old('date') }}">
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <div class="column column--half">
                        <label for="start_time">Van</label>
                        <input class="form__input {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="time" name="start_time" value="{{ old('start_time') }}">
                        @if ($errors->has('start_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_time') }}
                            </div>
                        @endif
                    </div>
                    <div class="column column--half">
                        <label for="end_time">Tot</label>
                        <input class="form__input {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="time" name="end_time" id="end-time" value="{{ old('end_time') }}">
                        @if ($errors->has('end_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('end_time') }}
                            </div>
                        @endif
                    </div>
                </div>


                @auth
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" class="form__input {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status">
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
                      <button type="submit" class="button button--primary">Opslaan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.footer')
@endsection
