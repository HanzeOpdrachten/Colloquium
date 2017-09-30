<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Colloquium</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('colloquia.index') }}">Colloquia</a>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('colloquia.create') }}">Colloquia toevoegen</a>
        </li>
        @can('view', \App\Training::class)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('trainings.index') }}">Opleidingen</a>
            </li>
        @endcan
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Inloggen</a>
            </li>
        @endguest
        @auth
            @can('view', \App\User::class)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">Gebruikers</a>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="document.getElementById('logoutForm').submit();">Uitloggen</a>
            </li>
        @endauth
    </ul>
  </div>
</nav>
@auth
    <form id="logoutForm" method="post" action="{{ route('logout') }}">
        {{ csrf_field() }}
    </form>
@endauth
