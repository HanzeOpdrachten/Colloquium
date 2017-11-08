<nav class="navigation">
  <div class="column column--whole">


    <div class="navigation__logo">
      <a href="/">
          <img src="{{ asset('/img/colloquium.svg') }}">
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
      @guest
        <li class="menu__item">
          <a class="menu__link" href="{{ route('colloquia.request') }}">Request colloquium</a>
        </li>
        <li class="menu__item">
          <a class="menu__link" href="{{ route('login') }}">Log in</a>
        </li>
      @endguest
      @auth
        @can('view', \App\Colloquium::class)
          <li class="menu__item">
            <a class="menu__link" href="{{ route('colloquia.index') }}">Colloquia</a>
          </li>
        @endcan
        @can('view', \App\Training::class)
          <li class="menu__item">
            <a class="menu__link" href="{{ route('trainings.index') }}">Trainings</a>
          </li>
        @endcan
        @can('view', \App\User::class)
          <li class="menu__item">
            <a class="menu__link" href="{{ route('users.index') }}">Users</a>
          </li>
        @endcan
        <li class="menu__item">
          <a class="menu__link" href="#" onclick="document.getElementById('logoutForm').submit();">Log out</a>
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
