@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.alerts')
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('users.create') }}" class="btn btn-primary float-right">Gebruikers toevoegen</a>
            </div>
        </div>
        <table class="table table-responsive mt-5">
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
                            <a data-href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger {{ Auth::user()->id == $user->id ? 'disabled' : ''}}" data-toggle="modal" data-target="#delete">Verwijderen</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="delete" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gebruiker verwijderen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-primary">Gebruiker verwijderen</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#delete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var href = button.data('href'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('form').attr('action', href);
            })
        </script>
    @endpush
@endsection
