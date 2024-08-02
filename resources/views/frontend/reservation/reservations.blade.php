@extends('frontend.dashboard')
@section('main')

<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Rezervacije</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="about-page-text">
        <div class="row">
            <div class="col-lg-8">
                <div class="ap-title">
                    <p>Ovdje možete pregledati sve vaše rezervacije i pratiti detalje o svakoj od njih. Imate pregled vaših trenutnih rezervacija kao i informacije o prošlim rezervacijama koje ste imali.</p>
                    <p>Na ovoj stranici možete provjeriti detalje o sobama koje ste rezervisali, datume dolaska i odlaska, kao i cijene i druge relevantne informacije. Također, ovdje možete izvršiti određenu akciju vezanu za vaše rezervacije, a to je otkazivanje.</p>
                </div>
                <br>
                <br>
                <div class="rd-reviews">
                    <h4>Rezervacije</h4>
                    @if(session('status'))
                    <div class="alert alert-success" role='alert'>
                        {{session('status')}}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger" role='alert'>
                        {{session('error')}}
                    </div>
                    @endif
                    @if($reservations->count() > 0)
                        @foreach($reservations as $reservation)
                            <div class="review-item">
                                <div class="ri-pic">
                                    <br>
                                    {{ Carbon\Carbon::parse($reservation->created_at)->diffForHumans()}}
                                </div>
                                <div class="ri-text">
                                    <span>{{ \Carbon\Carbon::parse($reservation->arriving_date)->format('d. F Y.') }}  |  </span>
                                    <span>{{ \Carbon\Carbon::parse($reservation->departure_date)->format('d. F Y.') }}</span>
                                    @if(Carbon\Carbon::now()->diffInDays($reservation->arriving_date, false) >= 1)
                                        <div class="rating">
                                        <button style="border: 2px solid #e1a974; color: #e1a974; padding: 3px 5px; width: 100%; background-color: #ffffff; text-transform: uppercase; font-size: 0.9rem;"><a href="{{ route('cancel.reservation', $reservation->id) }}" id="cancel" style="color: #e1a974">
                                        Otkaži rezervaciju</a></button>
                                        </div>
                                    @elseif($reservation->cancelled == "1")
                                        <div class="rating">
                                        <button style="border: 2px solid #dc3545; color: #dc3545; padding: 3px 5px; width: 100%; background-color: #ffffff; text-transform: uppercase; font-size: 0.9rem;">Otkazano</button>
                                        </div>
                                    @else
                                        <div class="rating">
                                        <button style="border: 2px solid #28a745; color: #28a745; padding: 3px 5px; width: 100%; background-color: #ffffff; text-transform: uppercase; font-size: 0.9rem;">Završeno</button>
                                        </div>
                                    @endif
                                    <h5>{{ $reservation->Room->name }}</h5>
                                    <p>{!! Illuminate\Support\Str::limit($reservation->Room->description, 400) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                    <h3>Nemate istoriju rezervacija</h3>
                    <br>
                    <button style="border: 2px solid #e1a974; color: #e1a974; padding: 12px 20px; width: 100%; background-color: #ffffff; text-transform: uppercase;">Pogledajte naše sobe</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection