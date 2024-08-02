@extends('frontend.dashboard')
@section('main')
<!-- Rooms Section Begin -->
<section class="rooms-section spad">
    <br>
    <br>
    <div class="breadcrumb-text">
        <h2>Dostupne sobe</h2>
        <br>
        <br>
    </div>
        <div class="container">
            <div class="row">
                @if($rooms && $rooms->count() > 0)
                @foreach($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{ asset('upload/room_images/main/'.$room->Picture->name) }}" style="height: 15rem;" alt="">
                        <div class="ri-text">
                            <h4>{{ $room->name }}</h4>
                            <h3>{{ $room->price }}€<span>/Noć</span></h3>
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
                            <a href="{{ route('room', $room->id) }}" class="primary-btn">Više detalja</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-12">
                    {{ $rooms->links('vendor.pagination.custom') }}
                </div>
                @else
                    <h2>Nema dostupnih soba</h2>
                @endif
            </div>
        </div>
    </section>
    <!-- Rooms Section End -->

@endsection