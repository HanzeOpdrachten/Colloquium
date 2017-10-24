@extends('layouts.app')

@section('content')
    <div class="column column--whole">
        @auth
            @can('create', \App\Colloquium::class)
                <a href="{{ route('colloquia.create') }}" class="button button--secondary button--right-float">Add colloquium</a>
            @endcan
        @endauth
    </div>

    <div class="starter-template">
        <h1>Colloquia</h1>
        @include('layouts.alerts')
        @if ($colloquia->count())
            <div class="col-xs-12 col-sm-12">
                <p>Below you'll find an overview of colloquia. They're ordered by their status.</p>

                <div class="table">
                    <table>
                        <thead class="thead-inverse">
                        <tr>
                            <th>Training</th>
                            <th>Title</th>
                            <th>Speaker</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Language</th>
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
                                <td><a href="{{ route('colloquia.show', $colloquium->id) }}">{{ $colloquium->title }}</a></td>
                                <td>{{ $colloquium->speaker }}</td>
                                <td>{{ $colloquium->location }}</td>
                                <td>{{ $colloquium->description }}</td>
                                <td>{{ $colloquium->start_date->format('d-m-Y H:s') }}</td>
                                <td>{{ $colloquium->language }}</td>
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
    </div>
@endsection

