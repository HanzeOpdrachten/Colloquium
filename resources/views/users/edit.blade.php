@extends('layouts.app')

@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'crumbs' => [
            'Home' => route('home'),
            'Gebruikers' => route('users.index'),
            'Gebruiker ' . $user->name => '#'
        ]
    ])
@endsection

@section('content')
    <div class="container">
        @include('layouts.alerts')
        <form method="post" action="{{ route('users.update', $user->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" class="form__input {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" value="{{ $user->name }}">
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">E-mailadres</label>
                <input type="email" class="form__input {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ $user->email }}">
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <select class="form__input {{ $errors->has('role') ? 'is-invalid' : '' }}" name="role">
                    @foreach($roles as $key => $name)
                        @if ($user->role == $key)
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
                    <button type="submit" class="button button--primary">Bijwerken</button>
                </div>
            </div>
        </form>
    </div>
@endsection