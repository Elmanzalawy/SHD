<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

    <a class="navbar-brand" href="{{ url('/index') }}"><b>SHD</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav text-left">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/index') }}">Home <span class="sr-only">(current)</span></a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/events') }}">Events</a>
      </li> --}}
    <!--EXAM ARCHIVE-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Exam Archive
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ url('/exams/level1.php') }}">Level 1</a>
          <a class="dropdown-item" href="{{ url('/exams/level2.php') }}">Level 2</a>
          <a class="dropdown-item" href="{{ url('/exams/level3.php') }}">Level 3</a>
          <a class="dropdown-item" href="{{ url('/exams/level4.php') }}">Level 4</a>
          <a class="dropdown-item" href="{{ url('/exams/level5.php') }}">Level 5</a>
        </div>
      </li>
    <!--ACADEMICS-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Lectures &amp; Sections</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ url('/lectures/level1.php') }}">Level 1</a>
          <a class="dropdown-item" href="{{ url('/lectures/level2.php') }}">Level 2</a>
          <a class="dropdown-item" href="{{ url('/lectures/level3.php') }}">Level 3</a>
          <a class="dropdown-item" href="{{ url('/lectures/level4.php') }}">Level 4</a>
          <a class="dropdown-item" href="{{ url('/lectures/level5.php') }}">Level 5</a>
        </div>
      </li>
    <!--ABOUT US-->
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/about') }}">About Us</a>
      </li>
      {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="calculatorDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Calculators <span class="soon">Soon</span></a>
          <div class="dropdown-menu" aria-labelledby="calculatorDropdown">
            <a class="dropdown-item" href="lectureArchive1.php">General</a>
            <a class="dropdown-item" href="lectureArchive2.php">Civil</a>
            <a class="dropdown-item" href="{{ url('/calculators/electronics') }}">Electronics</a>
            <a class="dropdown-item" href="lectureArchive4.php">Chemistry</a>
          </div>
      </li> --}}
      @if(!Auth::guest())
      <li class="nav-item">
      <a href="#" class="nav-link contact-us" data-toggle="modal" data-target="#contact-us-modal">Contact Us</a>
      </li>
      @endif
    
    </ul>
    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
  </ul>
    </div>
    </nav>