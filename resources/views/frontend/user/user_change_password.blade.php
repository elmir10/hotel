<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sona | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles  {{ asset('frontend/assets/') }} -->
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
                            <h2 class="mb-5">Promijeni lozinku</h2>
                            <form action="{{ route('user.update.password') }}" method="post" class="comment-form">
                                @csrf
                                @if(session('status'))
                                <div class="alert alert-success" role='alert'>
                                    {{session('status')}}
                                </div>
                                @elseif(session('error'))
                                <div class="alert alert-danger" role='alert'>
                                    {{session('error')}}
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                    <div>
                                        <!-- Old password -->
                                        <div class="mt-1">
                                            <x-text-input id="old_password" class="block mt-1 w-full" type="password" name="old_password" required autofocus autocomplete="name" placeholder="Tenutna lozinka"/>
                                            <x-input-error :messages="$errors->get('old_password')" class="alert alert-danger" style="list-style-type: none;"/>
                                        </div>

                                        <!-- New password -->
                                        <div class="mt-1">
                                            <x-text-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" required autocomplete="username" placeholder="Nova lozinka"/>
                                            <x-input-error :messages="$errors->get('new_password')" class="alert alert-danger" style="list-style-type: none;"/>
                                        </div>
                                        
                                        <!-- New password confirmation-->
                                        <div class="mt-1">
                                            <x-text-input id="new_password_confirmation" class="block mt-1 w-full" type="password" name="new_password_confirmation" required autocomplete="username" placeholder="Potvrda nove lozinke"/>
                                            <x-input-error :messages="$errors->get('new_password_confirmation')" class="alert alert-danger" style="list-style-type: none;"/>
                                        </div>
                                        
                                    </div>
                                    <br>
                                        <input type="submit" class="bk-btn" value="Sačuvaj izmjene" style="background-color: #d7ab7b; color: white;" onMouseOver="this.style.color='gray'" onMouseOut="this.style.color='white'">
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