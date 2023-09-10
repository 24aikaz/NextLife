{{-- THE HOME PAGE --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextLife V2</title>

    {{-- Token for CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- CDN for fontawesome icons --}}
    <script src="https://kit.fontawesome.com/726d0afaa7.js" crossorigin="anonymous"></script>
    
    {{-- CDN for AJAX --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    {{-- CDN for Bootstrap's JavaScript --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <section id="Navigation_Bar_Section">

        <nav id="NavBar" class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">

                <a class="NavBrand active navbar-brand NextLife underline clickable_stuff" href="/">NextLife</a>

                <span class="Slogan navbar-text">
                    Continue the history
                </span>

                <button class="NavTogBtn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <i class="HamburgerMenu fa-solid fa-bars clickable_stuff"></i>
                </button>

                <div class="LeftmostItems CollapseItems collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        <form action="{{ route('search') }}" class="d-flex" role="search" id="navsearch_form">
                            <input class="form-control me-2 SearchBar underline" name="query" type="search"
                                placeholder="Search item to bid!" autocomplete="off" id="search_input">
                            <button class="btn" type="submit"><i
                                    class="fa-solid fa-magnifying-glass clickable_stuff"></i></button>
                        </form>

                        <li class="nav-item">
                            <a class="nav-link underline clickable_stuff" href="{{ route('auctions') }}">Auctions</a>
                        </li>

                        @auth

                            @if (auth()->user()->usertype == 'bidder')
                                <li class="nav-item">
                                    <a class="nav-link underline clickable_stuff" href="{{ route('bids') }}">Bids</a>
                                </li>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('my-won-products') }}">Wins</a>
                                    </li>
                                </ul>
                            @endif

                            @if (auth()->user()->usertype == 'merchant')
                                <li class="nav-item">
                                    <a class="nav-link underline clickable_stuff"
                                        href="{{ route('auctionhouse') }}">House</a>
                                </li>
                            @endif

                            <li class="nav-item dropdown">
                                <a class="nav-link underline clickable_stuff" href="{{ route('profile') }}">Profile</a>
                            </li>

                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="">
                                    @csrf
                                    <button class="nav-link clickable_stuff" type="submit" title="Log out"><i
                                            class="fa-solid fa-arrow-right-from-bracket"></i></button>
                                </form>
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
