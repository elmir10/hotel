@extends('frontend.dashboard')
@section('main')

<!-- Room Details Section Begin -->
<section class="room-details-section spad">
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <img src="{{ url('upload/room_images/main/'.$room->Picture->name) }}" alt="" width="770px" height="440px">
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>{{ $room->name }}</h3>
                            <div class="rdt-right">
                                <a href="{{ route('reserve.room', $room->id) }}">Rezerviši sada</a>
                            </div>
                        </div>
                        <h2>{{ $room->price }}€<span>/Noć</span></h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="r-o">Površina:</td>
                                    <td>{{ $room->size }}m<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="r-o">Najviše osoba:</td>
                                    <td>{{ $room->capacity }}5</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Tip:</td>
                                    <td>{{ $room->Type->name }}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Usluge:</td>
                                    <td>
                                        <div class="blog-details-text">
                                            <div class="tag-share">
                                                <div class="tags">
                                                @if($room->wifi)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Wifi</a>
                                                @endif
                                                @if($room->air_condition)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Klima</a>
                                                @endif
                                                @if($room->tv)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">TV</a>
                                                @endif
                                                @if($room->balcony)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Terasa</a>
                                                @endif
                                                @if($room->sea_view)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Pogled na more</a>
                                                @endif
                                                @if($room->minibar)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Minibar</a>
                                                @endif
                                                @if($room->strongbox)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Sef</a>
                                                @endif
                                                @if($room->worktable)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Radni sto</a>
                                                @endif
                                                @if($room->sofa)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Fotelja</a>
                                                @endif
                                                @if($room->parking)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Parking</a>
                                                @endif
                                                @if($room->spa_and_wellness)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Spa i wellness</a>
                                                @endif
                                                @if($room->breakfast)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Doručak</a>
                                                @endif
                                                @if($room->no_smoking)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Za nepušače</a>
                                                @endif
                                                @if($room->crib)
                                                    <a href="#" onclick="return false;" style="margin-top:10px;">Krevetac</a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title">
                                        <span>Galerija</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($pictures)
                                    @foreach($pictures as $picture)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="gallery-item set-bg" data-setbg="{{ asset('upload/room_images/others/'.$picture->name) }}" style="background-image: url(&quot;img/gallery/gallery-3.jpg&quot;);">
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <p class="f-para">{!! $room->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Room Details Section End -->

@endsection