{{-- THE HOME PAGE --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextLife V2</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <script src="https://kit.fontawesome.com/726d0afaa7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>
    <section id="Navigation_Bar_Section">

        <nav id="NavBar" class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">

                <a class="NavBrand active navbar-brand NextLife underline clickable_stuff"
                    href="/">NextLife</a>

                <span class="Slogan navbar-text">
                    Continue the history
                </span>

                <button class="NavTogBtn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <i class="HamburgerMenu fa-solid fa-bars clickable_stuff"></i>
                </button>

                <div class="LeftmostItems CollapseItems collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        <form class="d-flex" role="search">
                            <input class="form-control me-2 SearchBar underline" type="search"
                                placeholder="Search item to bid!">
                            <button class="btn" type="submit"><i
                                    class="fa-solid fa-magnifying-glass clickable_stuff"></i></button>
                        </form>

                        <li class="nav-item">
                            <a class="nav-link underline clickable_stuff" href="#">Auctions</a>
                        </li>

                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link underline clickable_stuff" href="#">Profile</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link underline clickable_stuff" href="#">Bids</a>
                            </li>
                        @endauth

                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link underline clickable_stuff" href="{{ route('login') }}">Log In</a>
                            </li>
                        @endguest

                    </ul>
                </div>

            </div>
        </nav>

    </section>

    @yield('content')

    @vite(['resources/js/app.js'])
</body>

</html>
