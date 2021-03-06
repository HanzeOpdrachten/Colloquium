@extends('layouts.app')

@section('title', 'Trainings')

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Trainings' => '#'
    ]
  ])
@endsection

@section('content')
    <div class="column column--whole">
        <a href="{{ route('trainings.create') }}" class="button button--secondary button--right-float">Add training</a>
    </div>
    <div class="column column--whole">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
               @foreach($trainings as $training)
                        @if($training->id != 1)
                        <tr>
                            <td>{{ $training->name }}</td>
                            <td style="color: {{ $training->color }}">{{ $training->color }}</td>
                            <td>
                                <a href="{{ route('trainings.edit', $training->id) }}" class="button button--no-margin button--small button--info">Edit</a>
                                @if (Auth::user()->isSubscribed($training))
                                    <a href="{{ route('trainings.subscribe', $training->id) }}" class="button button--success button--small subscribe">Subscribe</a>
                                @else
                                    <a href="{{ route('trainings.unsubscribe', $training->id) }}" class="button button--no-margin button--small button--secondary subscribe">Subscribed</a>
                                @endif
                                <a data-href="{{ route('trainings.destroy', $training->id) }}" class="button button--no-margin button--small button--danger" data-toggle="modal" data-target="#delete">Delete</a>
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
                    <h5 class="modal-title">Delete training</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this training?
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="button button--no-margin button--primary">Delete training</button>
                    </form>
                    <button type="button" class="button button--no-margin button--secondary" data-dismiss="modal">Close</button>
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
