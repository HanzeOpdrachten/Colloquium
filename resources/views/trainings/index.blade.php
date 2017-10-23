@extends('layouts.app')

@section('content')
    <div class="column column--whole">
        <a href="{{ route('trainings.create') }}" class="button button--primary button--right-float">Opleiding toevoegen</a>
    </div>
    <div class="column column--whole">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Kleur</th>
                        <th>Opties</th>
                    </tr>
                </thead>
                <tbody>
               @foreach($trainings as $training)
                        @if($training->id != 1)
                        <tr>
                            <td>{{ $training->name }}</td>
                            <td>{{ $training->color }}</td>
                            <td>
                                <a href="{{ route('trainings.edit', $training->id) }}" class="btn btn-info">Bewerken</a>
                                @if (Auth::user()->isSubscribed($training))
                                    <a href="{{ route('trainings.subscribe', $training->id) }}" class="btn btn-success subscribe">Abonneren</a>
                                @else
                                    <a href="{{ route('trainings.unsubscribe', $training->id) }}" class="btn btn-secondary subscribe">Geabonneerd</a>
                                @endif
                                <a data-href="{{ route('trainings.destroy', $training->id) }}" class="btn btn-danger" data-toggle="modal" data-target="#delete">Verwijderen</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div id="delete" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Opleiding verwijderen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-primary">Opleiding verwijderen</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                </div>
            </div>
        </div>
    </div>

    <div id="subscribe" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">E-mails ontvangen van colloquia over: <span id="training-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="button button--primary">Gebruiker verwijderen</button>
                    </form>
                    <button type="button" class="button button--secondary" data-dismiss="modal">Sluiten</button>
                </div>
            </div>
        </div>
    </div>

    <form id="subscription" method="post" action="">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    </form>

    @push('scripts')
        <script>
            $('.subscribe').click(function(e) {
                e.preventDefault();

                var btn = $(this);
                var href = btn.attr('href');
                var subscription = $('#subscription');

              subscription.attr('action', href);
              subscription.submit();
        });
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
