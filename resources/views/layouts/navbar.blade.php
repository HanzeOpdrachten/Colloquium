<nav class="navigation">
  <div class="column column--whole">


    <div class="navigation__logo">
      <a href="/">
      </a>
    </div>

    <div id="js-menu-toggle" class="hamburger__wrapper">
      <a class="hamburger" href="#">
        <span class="hamburger__slice hamburger__slice--top"></span>
        <span class="hamburger__slice hamburger__slice--middle"></span>
        <span class="hamburger__slice hamburger__slice--middle"></span>
        <span class="hamburger__slice hamburger__slice--bottom"></span>
      </a>
    </div>

    <ul class="menu">
      <li class="menu__item">
        <a class="menu__link" href="/">Home</a>
      </li>
      <li class="menu__item">
        <a class="menu__link" href="{{ route('home') }}">Dashboard</a>
      </li>
      <li class="menu__item">
        <a class="menu__link" href="{{ route('colloquia.create') }}">Colloquia toevoegen</a>
      </li>
      @guest
        <li class="menu__item">
          <a class="menu__link" href="{{ route('login') }}">Inloggen</a>
        </li>
      @endguest
      @auth
        @can('view', \App\Training::class)
          <li class="menu__item">
            <a class="menu__link" href="{{ route('trainings.index') }}">Opleidingen</a>
          </li>
        @endcan
        @can('view', \App\User::class)
          <li class="menu__item">
            <a class="menu__link" href="{{ route('users.index') }}">Gebruikers</a>
          </li>
        @endcan
        <li class="menu__item">
          <a class="menu__link" href="#" onclick="document.getElementById('logoutForm').submit();">Uitloggen</a>
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
