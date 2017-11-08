@extends('layouts.app')

@section('title', 'Overview and manage')

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Colloquia' => '#'
    ]
  ])
@endsection

@section('content')
  <div class="column column--whole">
    @auth
      @can('create', \App\Colloquium::class)
        <a href="{{ route('colloquia.create') }}" class="button button--secondary button--right-float">Add colloquium</a>
      @endcan
    @endauth
  </div>

  <div class="box column column--whole">
    <h1 class="box__title">Colloquia</h1>
    <p class="box__content">Below you'll find an overview of colloquia. They're ordered by their status. To view a more detailed page, click on the title of a colloquia.</p>
  </div>

  @if ($colloquia->count())
    <div class="column column--whole">

      <div class="table">
        <table>
          <thead class="thead-inverse">
            <tr>
              <th>Training</th>
              <th>Title</th>
              <th>Speaker</th>
              <th>Location</th>
              <th>Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($colloquia as $colloquium)
              <tr data-link="{{ route('colloquia.show', $colloquium->id) }}" title="View a more detailed page for {{ $colloquium->title }}">
                <td class="clickable-colloquium">
                  <span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span>
                </td>
                <td class="clickable-colloquium">{{ $colloquium->title }}</td>
                <td class="clickable-colloquium">{{ $colloquium->speaker }}</td>
                <td class="clickable-colloquium">{{ $colloquium->location }}</td>
                <td class="clickable-colloquium">{{ $colloquium->start_date->format('d-m-Y H:s') }}</td>
                <td class="clickable-colloquium">
                  @if ($colloquium->isAwaiting())
                    <span style="color: orangered;">Awaiting</span>
                  @elseif ($colloquium->isAccepted())
                    <span style="color: green;">Accepted</span>
                  @elseif ($colloquium->isDeclined())
                    <span style="color: blue;">Declined</span>
                  @elseif ($colloquium->isCanceled())
                    <span style="color: red;">Canceled</span>
                  @endif
                </td>
                <td>
                  @if ($colloquium->isAwaiting())
                    <a href="{{ route('colloquia.accept', $colloquium->id) }}" class="button button--primary button--small">Accept</a>
                    <a href="{{ route('colloquia.decline', $colloquium->id) }}" class="button button--danger button--small">Decline</a>
                  @elseif ($colloquium->isAccepted())
                    <a href="{{ route('colloquia.decline', $colloquium->id) }}" class="button button--danger button--small">Decline</a>
                  @endif
                  <a data-href="{{ route('colloquia.destroy', $colloquium->id) }}" class="button button--small button--danger" data-toggle="modal" data-target="#delete">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div id="delete" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Colloquium</h5>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this colloquium?
                </div>

                <div class="modal-footer">
                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="button button--no-margin button--primary">Delete Colloquium</button>
                    </form>
                    <button type="button" class="button button--no-margin button--secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    <form id="colloquium" method="post" action="">
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
              var subscription = $('#colloquium');

              colloquium.attr('action', href);
              colloquium.submit();
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
  @else
    <p>There are no colloquia found.</p>
  @endif
@endsection
