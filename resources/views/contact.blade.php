<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us - Vegefoods</title>
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

    {{-- ✅ Contact Section --}}
    <section class="ftco-section contact-section bg-light">
        <div class="container">
            {{-- Cards Section --}}
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4 w-100 text-center">
                        <p><strong>Address:</strong><br> 198 West 21th Street,<br>Suite 721 Amman<br> Jordan</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4 w-100 text-center">
                        <p><strong>Phone:</strong><br> +962 775432428</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4 w-100 text-center">
                        <p><strong>Email:</strong><br> shurbaji@vegefoods.com</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4 w-100 text-center">
                        <p><strong>Website:</strong><br> www.vegefoods.com</p>
                    </div>
                </div>
            </div>
            @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
            {{-- Contact Form + Map --}}
            <form action="{{ route('contact.send') }}" method="POST" class="bg-white p-5 contact-form w-100">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                </div>
            </form>


                {{-- <div class="col-md-6 d-flex">
                    <div id="map" class="bg-white w-100 d-flex justify-content-center align-items-center" style="min-height: 100%;">
                        <p class="text-muted">Map Placeholder</p>
                    </div>
                </div>
            </div> --}}
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
