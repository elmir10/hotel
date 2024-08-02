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
                            <h1 class="mb-5">Registrujte se</h1>
                            <p class="mb-50">Već imate nalog? <a href="{{ route('login') }}" style="color:#d7ab7b" onMouseOver="this.style.color='black'" onMouseOut="this.style.color='#d7ab7b'">Prijavite se ovdje</a></p>
                            <form action="{{ route('register') }}" method="post" class="comment-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                    <div>
                                        <!-- Name -->
                                        <div class="mt-1">
                                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ime i prezime"/>
                                            <x-input-error :messages="$errors->get('name')" class="alert alert-danger" style="list-style-type: none;"/>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="mt-1">
                                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email"/>
                                            <x-input-error :messages="$errors->get('email')" class="alert alert-danger" style="list-style-type: none;"/>
                                        </div>

                                        <!-- Phone -->
                                        <div class="mt-1">
                                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" required autofocus placeholder="Telefon"/>
                                        </div>

                                        <!-- Address -->
                                        <div class="mt-1">
                                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"  required autofocus placeholder="Adresa"/>
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-1">
                                            <x-text-input id="password" class="block mt-1 w-full"
                                                            type="password"
                                                            name="password"
                                                            required autocomplete="new-password" placeholder="Lozinka"/>

                                            <x-input-error :messages="$errors->get('password')" class="alert alert-danger" style="list-style-type: none;"/>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-1">
                                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                            type="password"
                                                            name="password_confirmation" required autocomplete="new-password" placeholder="Potvrda lozinke"/>

                                            <x-input-error :messages="$errors->get('password_confirmation')" class="alert alert-danger" style="list-style-type: none;"/>
                                        </div>
                                    </div>
                                    <br>
                                        <input type="submit" class="bk-btn" value="Registruj se" style="background-color: #d7ab7b; color: white;" onMouseOver="this.style.color='gray'" onMouseOut="this.style.color='white'">
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