<nav class="navbar navbar-expand-lg navbar-dark" style="color: white;background-color: #032541;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Movie App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="fas fa-home"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Movies
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/movie/populer">Populer</a></li>
                        <li><a class="dropdown-item" href="/movie/now-playing">Now Playing</a></li>
                        <li><a class="dropdown-item" href="/movie/upcoming">Upcoming</a></li>
                        <li><a class="dropdown-item" href="/movie/top-rated">Top Rated</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    TV Series
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/tv/populer">Populer</a></li>
                        <li><a class="dropdown-item" href="/tv/airing-today">Airing Today</a></li>
                        <li><a class="dropdown-item" href="/tv/on-the-air">On the Air</a></li>
                        <li><a class="dropdown-item" href="/tv/top-rated">Top Rated</a></li>
                    </ul>
                </li>

            </ul>



            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                @auth

                <li class="nav-item">
                    <a href="/profile" class="nav-link">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    My Review
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/myWatchList">My Watch List</a></li>
                        <li><a class="dropdown-item" href="/myFavList">My Fav List</a></li>
                        <li><a class="dropdown-item" href="/myReview">My Movie Review</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i>Logout, {{ Auth::user()->firstname }}</a>
                </li>
                @endauth

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login"><i class="fas fa-sign-in"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                @endguest


            </ul>
        </div>
    </div>
</nav>

