@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.alerts')
        <div class="float-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Gebruikers toevoegen</a>
        </div>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>E-mailadres</th>
                    <th>Rol</th>
                    <th>Opties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if ($user->isAdmin())
                            <td>Administrator</td>
                        @elseif ($user->isPlanner())
                            <td>Planner</td>
                        @endif
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Bewerken</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection