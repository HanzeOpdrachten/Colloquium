@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('trainings.create') }}" class="btn btn-primary">Opleiding toevoegen</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive mt-3">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Kleur</th>
                            <th>Opties</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($trainings as $training)
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
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                        <button type="submit" class="btn btn-primary">Gebruiker verwijderen</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
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
    </script>
    @endpush
@endsection