@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{ route('trainings.update', $training->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" value="{{ $training->name }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="color">Kleur</label>
                        <input type="color" class="form-control {{ $errors->has('color') ? 'is-invalid': '' }}" name="color" id="color" value="{{ $training->name }}">
                        @if ($errors->has('color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('color') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Bijwerken</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection