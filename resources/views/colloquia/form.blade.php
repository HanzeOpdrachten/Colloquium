{{ csrf_field() }}
<div class="form-group">
    <label class="form__label" for="title">Subject</label>
    <input type="text" class="form__input {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title" value="{{ old('title') ?: $colloquium->title }}">
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="training">Prefered training for this colloquium</label>
    <select class="form__input {{ $errors->has('training_id') ? 'is-invalid' : '' }}" name="training_id" id="training">
        @foreach($trainings as $training)
            @if (old('training_id') && old('training_id') == $training->id || $colloquium->training_id && $colloquium->training_id == $training->id)
                <option value="{{ $training->id }}" selected>{{ $training->name }}</option>
            @else
                <option value="{{ $training->id }}">{{ $training->name }}</option>
            @endif
        @endforeach
    </select>
    @if ($errors->has('training_id'))
        <div class="invalid-feedback">
            {{ $errors->first('training_id') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="speaker">Speaker name</label>
    <input type="text" class="form__input {{ $errors->has('speaker') ? 'is-invalid' : '' }}" name="speaker" id="speaker" value="{{ old('speaker') ?: $colloquium->speaker }}">
    @if ($errors->has('speaker'))
        <div class="invalid-feedback">
            {{ $errors->first('speaker') }}
        </div>
    @endif
</div>

@guest
    <div class="form-group">
        <label for="email">E-mail address</label>
        <input type="text" class="form__input {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" value="{{ old('email') ?: $colloquium->email }}">
        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>
@endguest

<div class="form-group">
    <label for="location">Location of this colloquium</label>
    <input type="text" class="form__input {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location" value="{{ old('location') ?: $colloquium->location }}" placeholder="E.g.: ZP09/D220">
    @if ($errors->has('location'))
        <div class="invalid-feedback">
            {{ $errors->first('location') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="description">Short description</label>
    <textarea class="form__input {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" style="min-height:100px; max-height:200px;">{{ old('description') ?: $colloquium->description }}</textarea>
    @if ($errors->has('description'))
        <div class="invalid-feedback">
            {{ $errors->first('description') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="language">Spoken language</label>
    <input type="text" class="form__input {{ $errors->has('language') ? 'is-invalid' : '' }}" name="language" id="language" value="{{ old('language') ?: $colloquium->language }}">
    @if ($errors->has('language'))
        <div class="invalid-feedback">
            {{ $errors->first('language') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="date">Date</label>
    <input class="form__input {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date" id="date" value="{{ old('date') ?: $colloquium->start_date->format('Y-m-d') }}">
    @if ($errors->has('date'))
        <div class="invalid-feedback">
            {{ $errors->first('date') }}
        </div>
    @endif
</div>
<div class="form-group">
    <div class="column column--half">
        <label for="start_time">Start time</label>
        <input class="form__input {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="time" name="start_time" value="{{ old('start_time') ?: $colloquium->start_date->format('H:i') }}">
        @if ($errors->has('start_time'))
            <div class="invalid-feedback">
                {{ $errors->first('start_time') }}
            </div>
        @endif
    </div>
    <div class="column column--half">
        <label for="end_time">End</label>
        <input class="form__input {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="time" name="end_time" id="end-time" value="{{ old('end_time') ?: $colloquium->end_date->format('H:i') }}">
        @if ($errors->has('end_time'))
            <div class="invalid-feedback">
                {{ $errors->first('end_time') }}
            </div>
        @endif
    </div>
</div>


@auth
    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" class="form__input {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status">
            @foreach($statuses as $key => $value)
                @if (old('status') && $key == old('status') || $colloquium->status && $colloquium->status == $key)
                    <option value="{{ $key }}" selected>{{ $value }}</option>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
        @if ($errors->has('status'))
            <div class="invalid-feedback">
                {{ $errors->first('status') }}
            </div>
        @endif
    </div>
@endauth

<div class="form-group">
    <div class="float-right">
        <button type="submit" class="button button--primary">Save</button>
    </div>
</div>