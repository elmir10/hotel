<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" type="text/css">
</head>

<body>
    @include('frontend.body.header')
    <section class="blog-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-1">
                    <div class="blog-details-text">
                        <div class="leave-comment">
                            <h1 class="mb-3">Prijavite se</h1>
                            <p class="mb-50">Nemate nalog? <a href="{{ route('register') }}" style="color:#d7ab7b" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='#d7ab7b'">Napravite ovdje</a></p>
                            <form action="{{ route('login') }}" method="post" class="comment-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                    <div>
                                        <x-text-input placeholder="Email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

                                        @if (Route::has('password.request'))
                                            <a style="float: left; color: gray;" onMouseOver="this.style.color='#d7ab7b'" onMouseOut="this.style.color='gray'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                                {{ __('Zaboravili ste lozinku?') }}
                                            </a>
                                        @endif
                                        <x-text-input id="password" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password"
                                                        placeholder="Lozinka"
                                                        required autocomplete="current-password" />
                                                        <div class="flex items-center justify-end mt-4">
                                        
                                        <x-input-error :messages="$errors->get('password')" class="alert alert-danger" style="list-style-type: none;"/>
                                        <x-input-error :messages="$errors->get('email')" class="alert alert-danger" style="list-style-type: none;"/>
                                    </div>
                                    <br>
                                        <input type="submit" class="bk-btn" value="Prijavi se" style="background-color: #d7ab7b; color: white;" onMouseOver="this.style.color='gray'" onMouseOut="this.style.color='white'">
                                    </div>
                                </div>
              
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.body.footer')

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
</body>

</html>