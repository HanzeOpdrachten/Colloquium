@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.alerts')
        <div class="col-md-6">
            <form method="post" action="{{ route('users.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" >
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">E-mailadres</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password">
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="confirmation">Herhaal wachtwoord</label>
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation" id="confirmation">
                    @if ($errors->has('confirmation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('confirmation') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="role">Rol</label>
                    <select class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role">
                        @foreach($roles as $key => $name)
                            @if (old('role') == $key)
                                <option value="{{ $key }}" selected>{{ $name }}</option>
                            @else
                                <option value="{{ $key }}">{{ $name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <div class="invalid-feedback">
                            {{ $errors->first('role') }}
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
