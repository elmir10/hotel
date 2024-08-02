@php
$route = Route::current()->getName();

@endphp

<!-- Page Preloder -->
<div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
        <div class="header-configure-area">
            <a href="#" disabled style="cursor: default;" class="bk-btn">Rezervišite online</a>
        </div>
        <nav class="mainmenu mobile-menu">
            <ul>
                <li class="{{ ($route=='home')? 'active' : '' }}"><a href="/">Početna</a></li>
                <li class="{{ ($route=='all.rooms')? 'active' : '' }}"><a href="{{ route('all.rooms') }}">Sobe</a></li>
                <li class="{{ ($route=='about')? 'active' : '' }}"><a href="{{ route('about') }}">O nama</a></li>
                <li class="{{ ($route=='contact')? 'active' : '' }}"><a href="{{ route('contact') }}">Kontakt</a></li>
                @auth
                    <li><a href="#"><i class="fa fa-user"></i> Nalog</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('user.profile') }}"><i class="fa fa-address-card"></i>  Profil</a></li>
                            <li><a href="{{ route('user.change.password') }}"><i class="fa fa-key"></i> Lozinka</a></li>
                            <li><a href="{{ route('user.reservations') }}"><i class="fa fa-bed"></i> Rezervacije</a></li>
                            <li style="border-top: 1px solid black;"><a href="{{ route('user.logout') }}"><i class="fa fa-arrow-right"></i> Odjavi se</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Prijava</a></li>
                    <li><a href="{{ route('register') }}">Registracija</a></li>
                @endauth
            </ul>
        </nav>
        
        <div id="mobile-menu-wrap"></div>
        <div class="top-social">
            <a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a>
            <a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
            <a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
        </div>
        <ul class="top-widget">
            <li><i class="fa fa-phone"></i> +382-68/000/000</li>
            <li><i class="fa fa-envelope"></i> info@gmail.com</li>
        </ul>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tn-left">
                            <li><i class="fa fa-phone"></i> +382-68/000/000</li>
                            <li><i class="fa fa-envelope"></i> info@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tn-right">
                            <div class="top-social">
                                <a href="https://www.facebok.com"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com"><i class="fa fa-instagram"></i></a>
                            </div>
                            <a href="#" disabled style="cursor: default;" class="bk-btn">Rezervišite online</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="/">
                                <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="{{ ($route=='home')? 'active' : '' }}"><a href="/">Početna</a></li>
                                    <li class="{{ ($route=='all.rooms')? 'active' : '' }}"><a href="{{ route('all.rooms') }}">Sobe</a></li>
                                    <li class="{{ ($route=='about')? 'active' : '' }}"><a href="{{ route('about') }}">O nama</a></li>
                                    <li class="{{ ($route=='contact')? 'active' : '' }}"><a href="{{ route('contact') }}">Kontakt</a></li>
                                </ul>
                            </nav>
                            <div class="mainmenu" style="margin-left: 2rem;">
                                @auth
                                <li><a href="#"><i class="fa fa-user"></i> Nalog</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('user.profile') }}"><i class="fa fa-address-card"></i>  Profil</a></li>
                                        <li><a href="{{ route('user.change.password') }}"><i class="fa fa-key"></i> Lozinka</a></li>
                                        <li><a href="{{ route('user.reservations') }}"><i class="fa fa-bed"></i> Rezervacije</a></li>
                                        <li style="border-top: 1px solid black;"><a href="{{ route('user.logout') }}"><i class="fa fa-arrow-right"></i> Odjavi se</a></li>
                                    </ul>
                                </li>
                                @else
                                <a href="{{ route('login') }}" style="color:black;" onMouseOver="this.style.color='#d7ab7b'" onMouseOut="this.style.color='black'">Prijava</a> |
                                <a href="{{ route('register') }}" style="color:black;" onMouseOver="this.style.color='#d7ab7b'" onMouseOut="this.style.color='black'">Registracija</a> 
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->