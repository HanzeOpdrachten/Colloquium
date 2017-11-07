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
              <tr>
                <td>
                  <span style="color: {{ $colloquium->training->color }};">{{ $colloquium->training->name }}</span>
                </td>
                <td><a href="{{ route('colloquia.show', $colloquium->id) }}" title="View a more detailed page for {{ $colloquium->title }}">{{ $colloquium->title }}</a></td>
                <td>{{ $colloquium->speaker }}</td>
                <td>{{ $colloquium->location }}</td>
                <td>{{ $colloquium->start_date->format('d-m-Y H:s') }}</td>
                <td>
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
                  <a href="#" class="button button--danger button--small">Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <p>There are no colloquia found.</p>
  @endif
@endsection
