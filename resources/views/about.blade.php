<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us - Vegefoods</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    {{-- CSS Files --}}
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="goto-here">

    {{-- ✅ Navbar --}}
    @include('navbar')

    {{-- ✅ About Content --}}
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container py-5">
            <div class="row d-flex justify-content-center py-5">
                <div class="col-md-10 text-center">
                    <h2 class="mb-4">About Our Project</h2>
                    <p class="lead">
                        Welcome to <strong>Vegefoods</strong> – the smart way to shop and save!
                    </p>
                    <p>
                        We are a modern e-commerce platform that helps reduce food waste by offering significant discounts on grocery items that are close to their expiration dates but are still perfectly safe and consumable.
                    </p>
                    <p>
                        Every year, tons of food go to waste simply because of approaching expiry dates. Our mission is to change that by connecting customers with great products at reduced prices — all while helping the environment.
                    </p>
                    <hr class="my-4" style="width: 60px; border-color: #82ae46;">
                    <h4 class="mb-3">What We Offer:</h4>
                    <ul class="list-unstyled mb-4">
                        <li>🛒 High-quality food and beverages at discounted prices</li>
                        <li>📆 Clear information on product expiration dates</li>
                        <li>♻️ A more sustainable shopping experience</li>
                        <li>💸 Great value for your money</li>
                    </ul>
                    <p>
                        Whether you’re a student, a large family, or simply someone looking to save, our platform is designed for you. Shop responsibly, eat well, and be part of the solution!
                    </p>
                    <p><strong>Together, we can reduce food waste — one product at a time.</strong></p>

                    <a href="{{ url('/home ') }}" class="btn btn-primary mt-3">⬅ Back to Home</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ✅ Footer --}}
    @include('footer')

    {{-- ✅ JS Files --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
