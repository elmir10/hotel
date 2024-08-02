@extends('frontend.dashboard')
@section('main')

@php
$rooms = App\Models\Room::orderBy('price')
    ->take(4)
    ->get()
    ->shuffle();
@endphp

<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Hotel Berane</h1>
                    <p>Naša misija je da vam pružimo nezaboravan boravak koji prevazilazi vaša očekivanja. Naš ljubazan i profesionalan tim osoblja je posvećen tome da vam obezbedi sve što vam je potrebno, kako biste se osećali kao kod kuće.</p>
                    <a href="#" class="primary-btn">Pogledajte sobe</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                <div class="booking-form">
                    <h3>Rezervišite sobu</h3>
                    <form action="{{ route('check_available_rooms') }}" method="post">
                    @csrf
                    <div class="check-date">
                        <x-input-error :messages="$errors->get('date_in')" class="text-danger" style="list-style-type: none;"/>
                        <label for="date-in">Dolazak</label>
                            <input type="text" class="date-input" name="date_in" id="date-in">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="check-date">
                            <x-input-error :messages="$errors->get('date_out')" class="text-danger" style="list-style-type: none;"/>
                            <label for="date-out">Odlazak</label>
                            <input type="text" class="date-input" name="date_out" id="date-out">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="select-option">
                        <x-input-error :messages="$errors->get('guests')" class="alert alert-danger" style="list-style-type: none;"/>
                            <label for="guest">Broj osoba:</label>
                            <select id="guest" name="guests">
                                <option value="1">1 Osoba</option>
                                <option value="2">2 Osobe</option>
                                <option value="3">3 Osobe</option>
                                <option value="4">4 Osobe</option>
                                <option value="5">5 Osobe</option>
                                <option value="6">6 Osobe</option>
                                <option value="7">7 Osobe</option>
                            </select>
                        </div>
                        <br>
                        @if(session('status'))
                        <div class="alert alert-success" role='alert'>
                            {{session('status')}}
                        </div>
                        @elseif(session('error'))
                        <div class="alert alert-danger" role='alert'>
                            {{session('error')}}
                        </div>
                        @endif
                        <input type="submit" value="Pogledajte dostupnost" style="border: 2px solid #e1a974; color: #e1a974; padding: 12px 20px; width: 100%; background-color: #ffffff; text-transform: uppercase;">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="{{ asset('frontend/assets/img/hero/hero-1.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('frontend/assets/img/hero/hero-2.jpg') }}"></div>
        <div class="hs-item set-bg" data-setbg="{{ asset('frontend/assets/img/hero/hero-3.jpg') }}"></div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Services Section End -->
<section class="services-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Naša djelatnost</span>
                    <h2>Istražite naše usluge</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="service-item">
                    <i class="flaticon-033-dinner"></i>
                    <h4>Catering usluga</h4>
                    <p>Uživajte u našoj vrhunskoj usluzi cateringa koja će zadovoljiti sva vaša nepca.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="service-item">
                    <i class="flaticon-024-towel"></i>
                    <h4>Vešeraj</h4>
                    <p>Nudimo sveobuhvatnu uslugu pranja veša koja će vam omogućiti da uživate u čistoj, svježoj i savršeno očišćenoj odjeći.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="service-item">
                    <i class="flaticon-012-cocktail"></i>
                    <h4>Bar & piće</h4>
                    <p>U našem hotelu možete uživati u bogatom izboru pića i opuštenoj atmosferi našeg bara.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Home Room Section Begin -->
<section class="hp-room-section">
    <div class="container-fluid">
        <div class="hp-room-items">
            <div class="row">
                @foreach($rooms as $room)
                <div class="col-lg-3 col-md-6">
                    <div class="hp-room-item set-bg" data-setbg="{{ asset('upload/room_images/main/'.$room->Picture->name) }}">
                        <div class="hr-text">
                            <h3>{{ $room->name }}</h3>
                            <h2>{{ $room->price }}€<span>/Noć</span></h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Površina:</td>
                                        <td>{{ $room->size }}m<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Broj osoba:</td>
                                        <td>Najviše {{ $room->capacity }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Tip:</td>
                                        <td>{{ $room->Type->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Usluge:</td>
                                        <td>Wifi, Parking, Klima, tv,...</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-btn">Pogledaj detaljnije</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Home Room Section End -->

<!-- About Us Section Begin -->
<section class="aboutus-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-text">
                    <div class="section-title">
                        <span>O nama</span>
                        <h2>Hotel Berane</h2>
                    </div>
                    <p class="f-para">Mi smo prestižni hotel koji se ponosi pružanjem vrhunskog iskustva gostima širom svijeta. Sa neuporedivom kombinacijom udobnosti, luksuza i besprekorne usluge, mi smo vaša destinacija iz snova za savršen odmor.</p>
                    <p class="s-para">Dobrodošli u naš hotel, gdje se luksuz, udobnost i vrhunska usluga spajaju kako bismo vam pružili iskustvo koje ćete pamtiti zauvijek.</p>
                    <a href="#" class="primary-btn about-btn">Pročitaj više</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-pic">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('frontend/assets/img/about/about-2.jpg') }}" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('frontend/assets/img/about/about-2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Section End -->
<br>
<br>
@endsection