<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - {{ config('app.name', 'Output Based Incentive Recycle V.1.0') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('gambar/sistem/pavicon.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        /* .background-slide {
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        } */
    </style>
</head>

<body>
    <div class="row" style="position: relative">
        <div class="col-lg-8 col-md-12 px-0">
            <!-- ======= Hero Section ======= -->
            <section id="hero">
                <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

                    <div class="carousel-inner" role="listbox">
                        <!-- Slide 1 -->
                        <div class="carousel-item background-slide active"
                            style="background-image: url(assets/img/slide/slide-1.jpg);  background-size: contain; background-position: center; background-color: #FFFFFF;">
                        </div>

                        <!-- Slide 2 -->
                        <div class="carousel-item background-slide"
                            style="background-image: url(assets/img/slide/slide-2.jpg);  background-size: contain; background-position: center; background-color: white;">
                        </div>

                        <!-- Slide 3 -->
                        <div class="carousel-item background-slide"
                            style="background-image: url(assets/img/slide/slide-3.jpg);  background-size: contain; background-position: center; background-color: white;">
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                        <span aria-hidden="true">
                            <svg style="border-radius:50%; width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.2);"
                                version="1.1" id="Chevron_small_left" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20"
                                enable-background="new 0 0 20 20" xml:space="preserve">
                                <path style="fill: rgba(255, 255, 255, 0.5);"
                                    d="M12.141,13.418c0.268,0.271,0.268,0.709,0,0.978c-0.268,0.27-0.701,0.272-0.969,0l-3.83-3.908
                                c-0.268-0.27-0.268-0.707,0-0.979l3.83-3.908c0.267-0.27,0.701-0.27,0.969,0c0.268,0.271,0.268,0.709,0,0.978L9,10L12.141,13.418z" />
                            </svg>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                        <span aria-hidden="true">
                            <svg style="border-radius:50%; width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.2);"
                                version="1.1" id="Chevron_small_right" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20"
                                enable-background="new 0 0 20 20" xml:space="preserve">
                                <path style="fill: rgba(255, 255, 255, 0.5);"
                                    d="M11,10L7.859,6.58c-0.268-0.27-0.268-0.707,0-0.978c0.268-0.27,0.701-0.27,0.969,0l3.83,3.908
                           c0.268,0.271,0.268,0.709,0,0.979l-3.83,3.908c-0.267,0.272-0.701,0.27-0.969,0c-0.268-0.269-0.268-0.707,0-0.978L11,10z" />
                            </svg>
                            </spanaria-hidden=>
                            <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
            <!-- End Hero -->
        </div>
        <div class="col-lg-4 col-md-12 fixed-right">
            <div class="login-form mb-0 pt-5 pl-1 pr-3">
                <div class="card-body pt-5 pb-5">
                    <div class="text-center mb-5">
                        <img src="{{ asset('gambar/sistem/swi_logo.jpeg')}}" alt="" style="height: 100px">
                        <h5 class="mt-4">Plastic Collection Incentive Program</h5>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <div class="form-group has-feedback">
                                <input id="email" type="text" placeholder="Email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="off">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group has-feedback">
                                <input id="password" type="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('LOGIN') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>