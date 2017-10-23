@extends('layouts.app')

@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'crumbs' => [
            'Home' => route('home'),
            'Trainings' => route('trainings.index'),
            'Add training' => '#'
        ]
    ])
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{ route('trainings.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form__input {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="color">Color</label>

                      <div class="input-group colorpicker colorpicker-component">
                        <input type="text" value="#000000" name="color" id="color" class="form__input {{ $errors->has('color') ? 'is-invalid' : '' }}" />
                        <span class="input-group-addon"><i></i></span>
                      </div>

                      @if ($errors->has('color'))
                          <div class="invalid-feedback">
                              {{ $errors->first('color') }}
                          </div>
                      @endif
                    </div>

                    <div class="form-group">
                        <div class="float-right">
                            <button type="submit" class="button button--primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
  <script type="text/javascript">
    $('.colorpicker').colorpicker();
  </script>
@endpush
