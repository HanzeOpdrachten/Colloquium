@if (session('success'))
  <div class="column column--whole">
    <div class="alert alert--success">
      {!! session('success') !!}
    </div>
  </div>
@endif

@if (session('danger'))
  <div class="column column--whole">
    <div class="alert alert--danger">
      {!! session('danger') !!}
    </div>
  </div>
@endif
