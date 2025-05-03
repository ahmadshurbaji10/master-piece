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
                {{-- بطاقة العنوان --}}
                <div class="col-md-3 d-flex mb-4 mb-md-0">
                    <div class="info bg-white p-4 w-100 text-center contact-card">
                        <i class="fas fa-map-marker-alt mb-3 text-success"></i>
                        <h5 class="mb-3">Address</h5>
                        <p>198 West 21th Street,<br>Suite 721 Amman<br>Jordan</p>
                    </div>
                </div>

                {{-- بطاقة الهاتف --}}
                <div class="col-md-3 d-flex mb-4 mb-md-0">
                    <div class="info bg-white p-4 w-100 text-center contact-card">
                        <i class="fas fa-phone mb-3 text-success"></i>
                        <h5 class="mb-3">Phone</h5>
                        <p>+962 775432428</p>
                    </div>
                </div>

                {{-- بطاقة البريد --}}
                <div class="col-md-3 d-flex mb-4 mb-md-0">
                    <div class="info bg-white p-4 w-100 text-center contact-card">
                        <i class="fas fa-envelope mb-3 text-success"></i>
                        <h5 class="mb-3">Email</h5>
                        <p>shurbaji@vegefoods.com</p>
                    </div>
                </div>

                {{-- بطاقة الموقع --}}
                <div class="col-md-3 d-flex mb-4 mb-md-0">
                    <div class="info bg-white p-4 w-100 text-center contact-card">
                        <i class="fas fa-globe mb-3 text-success"></i>
                        <h5 class="mb-3">Website</h5>
                        <p>www.vegefoods.com</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </section>

    <style>
        .contact-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            border: 1px solid rgba(130, 174, 70, 0.1);
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .contact-card i {
            font-size: 2rem;
        }

        .contact-card h5 {
            color: #82ae46;
            font-weight: 600;
        }

        .contact-card p {
            margin-bottom: 0;
            color: #555;
        }
    </style>
            {{-- Contact Form + Map --}}
            <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
                @csrf
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-submit">
                        Send Message
                    </button>
                </div>
            </form>

            <style>
                .contact-form {
                    max-width: 800px;
                    margin: 0 auto;
                    padding: 30px;
                    background: #fff;
                    border-radius: 10px;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                }

                .form-group {
                    margin-bottom: 25px;
                }

                .form-group label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: 500;
                    color: #333;
                }

                .form-control {
                    width: 100%;
                    padding: 12px 15px;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    font-size: 16px;
                    transition: border-color 0.3s;
                }

                .form-control:focus {
                    border-color: #82ae46;
                    outline: none;
                    box-shadow: 0 0 0 3px rgba(130, 174, 70, 0.2);
                }

                textarea.form-control {
                    min-height: 150px;
                    resize: vertical;
                }

                .btn-submit {
                    background: #82ae46;
                    color: white;
                    border: none;
                    padding: 14px 30px;
                    border-radius: 6px;
                    font-size: 16px;
                    font-weight: 600;
                    cursor: pointer;
                    width: 100%;
                    transition: background 0.3s;
                }

                .btn-submit:hover {
                    background: #6c9440;
                }
            </style>


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
