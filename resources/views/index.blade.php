@extends('app')

@section('home')
    <section id="Title_Display">
        <div class="section_content text_margin">
            <h1>Bring to your home a piece of history</h1>
            <p style="width: 50%;">Bid on our exquisite and verified auctioned products to create your own legacy
                today.</p>
        </div>
    </section>

    <section id="Text_Section1" class="reveal">
        <h2 class="text_margin">Discover our products</h2>
        <p class="text_margin">Discover the magic of bidding on our exceptional products - where dreams meet their perfect
            match!</p>
    </section>

    <section id="Product_Showcase" class="section_content container">
        <div id="Product_Container" class="row">
            <div id="Product_1" class="card1 col reveal">
                <div class="content">
                    <div class="front">
                        <img class="image" src="{{ asset('images/Objects/retroTV.png') }}" alt="Retro TV">
                    </div>
                    <div class="back">
                        <p>Imagine yourself sitting in front of this beautifully designed television, a true testament
                            to the craftsmanship of the past. This vintage TV carries with it a rich history,
                            representing an era when television sets were not just devices but pieces of art, lovingly
                            created with attention to detail and style.</p>
                        <a href="#"><i class="fa-solid fa-arrow-right clickable_stuff"></i></a>
                    </div>
                </div>
            </div>
            <div id="Product_2" class="card1 col reveal">
                <div class="content">
                    <div class="front">
                        <img class="image" src="{{ asset('images/Objects/Cam.png') }}" alt="Vintage Camera">
                    </div>
                    <div class="back">
                        <p>Are you a collector seeking to add a rare gem to your curated assortment of photographic
                            memorabilia? Look no further, as we present to you an extraordinary vintage camera that will
                            transport you to a bygone era of artistic exploration and timeless elegance!</p>
                        <a href="#"><i class="fa-solid fa-arrow-right clickable_stuff"></i></a>
                    </div>
                </div>
            </div>
            <div id="Product_3" class="card1 col reveal">
                <div class="content">
                    <div class="front">
                        <img class="image" src="{{ asset('images/Objects/LionSculp.png') }}" alt="Lion Sculpture">
                    </div>
                    <div class="back">
                        <p>Whether you're an art enthusiast, a wildlife lover, or someone seeking to add a touch of
                            grandeur to your surroundings, this sculpture is a true collector's dream. Its age and
                            history add a layer of intrigue and uniqueness, making it stand out among contemporary
                            pieces.</p>
                        <a href="#"><i class="fa-solid fa-arrow-right clickable_stuff"></i></a>
                    </div>
                </div>
            </div>
            <div>
    </section>

    <section id="Auctioneer_Team" class="section_content">
        <div class="reveal">
            <h2 class="text_margin">Our Auctioneers</h2>
            <p class="text_margin">Thrilled to work with our talented auctioneers - masters of their craft, who make every
                bid an
                exhilarating experience!</p>
        </div>
        <div id="Profile_Display" class="reveal">
            <img class="auctioneer_img p1" src="{{ asset('images/Auctioneers/AdelaideAshford.png') }}"
                alt="Adelaide Ashford">
            <img class="auctioneer_img p2" src="{{ asset('images/Auctioneers/AdityaMishraChakraborty.png') }}"
                alt="Aditya Mishra Chakraborty">
            <img class="auctioneer_img p3" src="{{ asset('images/Auctioneers/AnastasiaFriedaSchneider.png') }}"
                alt="Anastasia Frieda Schneider">
            <img class="auctioneer_img p4" src="{{ asset('images/Auctioneers/NicholasForbes.png') }}" alt="Nicholas Forbes">
            <img class="auctioneer_img p5" src="{{ asset('images/Auctioneers/OlivierSaint-Clair.png') }}"
                alt="Olivier Saint-Clair">
            <img class="auctioneer_img p6" src="{{ asset('images/Auctioneers/PenelopeWellington.png') }}"
                alt="Penelope Wellington">
            <img class="auctioneer_img p7" src="{{ asset('images/Auctioneers/WilliamVonFitzgerald.png') }}"
                alt="William Von Fitzgerald">
            <img class="auctioneer_img p8" src="{{ asset('images/Auctioneers//YunaMeiTanaka.png') }}"
                alt="Yuna Mei Tanaka">
        </div>
    </section>

    <section id="Text_Section2" class="">
        <p>Unforgettable treasures find new homes through our auctioned products - where each bid opens a world of
            possibilities!</p>
        <a href="#" class="underline_middle">Start bidding now!</a>
    </section>

    <div id="Fixed_Background" class="parallax-container"></div>

    <footer id="Page_Footer" class="">
        <div id="footer_content">
            <h3 class="Brand">NextLife</h3>
            <h4>Continue the history</h4>
            <a href="#" class="underline">About Us</a>
            <a href="#" class="underline">Our Team</a>
            <a href="#" class="underline">Contact Us</a>
            <p><i class="fa-regular fa-copyright"></i>2023 NextLife by Ashley & Zakiyyah</p>
        </div>
    </footer>
@endsection
