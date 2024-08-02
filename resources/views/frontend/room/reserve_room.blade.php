@extends('frontend.dashboard')
@section('main')
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Rezervišite sobu</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            @if(session('status'))
            <div class="alert alert-success" role='alert'>
                {{session('status')}}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger" role='alert'>
                {{session('error')}}
            </div>
            @endif
            <form action="{{ route('send.request') }}" method="post" class="contact-form">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

                @auth

                @else
                <div class="row">
                    <div class="col-lg-6">
                        <x-input-error :messages="$errors->get('name')" class="text-danger" style="list-style-type: none;"/>
                        <input type="text" placeholder="Ime i prezime" name="name">
                    </div>
                    <div class="col-lg-6">
                        <x-input-error :messages="$errors->get('email')" class="text-danger" style="list-style-type: none;"/>
                        <input type="text" placeholder="Email" name="email">
                    </div>
                    <div class="col-lg-12">
                        <x-input-error :messages="$errors->get('address')" class="text-danger" style="list-style-type: none;"/>
                        <input placeholder="Adresa" name="address">
                    </div>
                    <div class="col-lg-12">
                        <x-input-error :messages="$errors->get('phone')" class="text-danger" style="list-style-type: none;"/>
                        <input placeholder="Telefon" name="phone">
                    </div>
                @endauth
                    <div class="col-lg-12">
                        <x-input-error :messages="$errors->get('date_in')" class="text-danger" style="list-style-type: none;"/>
                        <input placeholder="Dolazak" name="date_in" type="text" class="date-input" name="date_in" id="date-in">
                    </div>
                    <div class="col-lg-12">
                        <x-input-error :messages="$errors->get('date_out')" class="text-danger" style="list-style-type: none;"/>
                        <input placeholder="Odlazak" name="date_out" type="text" class="date-input" name="date_out" id="date-out">
                    </div>
                    <div class="col-lg-12">
                        <button type="submit">Pošalji</button>
                    </div>
                </div>
            </form>
            <br>
            <br>
        </div>
        <br>
        <br>
        <div class="col-lg-4">
            <div class="room-details-item">
                <div class="rd-text">
                    <div class="row">
                        <div class="col-md-6">
                            <span style="font-size: 1.5rem;">Broj noći: </span>
                        </div>
                        <div class="col-md-6">
                            <h3 id="nights" name="nights" style="color: #e1a974;">1</h3>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span style="font-size: 1.5rem;">Cijena: </span>
                        </div>
                        <div class="col-md-6">
                            <h3 id="price" name="price" style="color: #e1a974;">{{ $room->price }}€</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Funkcija koja računa broj dana između dvaju datuma
function calculateDays(date1, date2) {
  const oneDay = 24 * 60 * 60 * 1000; // Broj milisekundi u jednom danu
  const firstDate = new Date(date1);
  const secondDate = new Date(date2);
  const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
  return diffDays;
}


function updatePriceAndNights() {
  const dateInInput = document.getElementById('date-in');
  const dateOutInput = document.getElementById('date-out');
  const nightsElement = document.getElementById('nights');
  const priceElement = document.getElementById('price');

  const dateIn = dateInInput.value;
  const dateOut = dateOutInput.value;

  
  if (dateIn && dateOut) {
    const diffDays = calculateDays(dateIn, dateOut);

    
    if (diffDays > 0 && new Date(dateIn) <= new Date(dateOut)) {
      const price = diffDays * parseFloat("{{$room->price}}");
      nightsElement.innerText = diffDays;
      priceElement.innerText = price.toFixed(2) + '€';
    }
  }
}


setInterval(updatePriceAndNights, 500);


</script>


@endsection