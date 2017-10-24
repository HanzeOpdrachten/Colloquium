@extends('layouts.app')

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Users' => '#'
    ]
  ])
@endsection

@section('content')
    <div class="column column--whole">
        @include('layouts.alerts')

        <a href="{{ route('users.create') }}" class="button button--secondary button--right-float">Add user</a>
    </div>

    <div class="column column--whole">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
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
                                <a href="{{ route('users.edit', $user->id) }}" class="button button--info button--small button--no-margin">Edit</a>
                                <a data-href="{{ route('users.destroy', $user->id) }}" class="button button--danger button--small button--no-margin {{ Auth::user()->id == $user->id ? 'button--disabled' : ''}}" data-toggle="modal" data-target="#delete">Delete</a>
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
                    <h5 class="modal-title">Delete user</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <form method="post" action="">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="button button--primary">Delete user</button>
                    </form>
                    <button type="button" class="button button--secondary" data-dismiss="modal">Cancel</button>
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
