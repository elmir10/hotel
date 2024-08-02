@extends('frontend.dashboard')
@section('main')

<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-text">
                    <h2>Kontakt informacije</h2>
                    <p>Za sve dodatne informacije i rezervacije, možete nas kontaktirati na sledeće kontakte.</p>
                    <table>
                        <tbody>
                            <tr>
                                <td class="c-o">Adresa:</td>
                                <td>Ivangradska 1</td>
                            </tr>
                            <tr>
                                <td class="c-o">Telefon:</td>
                                <td>+382-68/000/000</td>
                            </tr>
                            <tr>
                                <td class="c-o">Email:</td>
                                <td>info@gmail.com</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1">

                    @if(session('status'))
                    <div class="alert alert-success" role='alert'>
                        {{session('status')}}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger" role='alert'>
                        {{session('error')}}
                    </div>
                    @endif
                <form action="{{ route('message') }}" method="post" class="contact-form">
                    @csrf

                    @auth

                    @else
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" placeholder="Ime i prezime" name="name">
                            <x-input-error :messages="$errors->get('name')" class="alert alert-danger" style="list-style-type: none;"/>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" placeholder="Email" name="email">
                            <x-input-error :messages="$errors->get('email')" class="alert alert-danger" style="list-style-type: none;"/>
                        </div>
                    @endauth
                        <div class="col-lg-12">
                            <textarea placeholder="Poruka" name="message"></textarea>
                            <x-input-error :messages="$errors->get('message')" class="alert alert-danger" style="list-style-type: none;"/>
                            <button type="submit">Pošalji</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2925.2747544476606!2d19.87578367634857!3d42.845931371152005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135293bf7d1a8edd%3A0x4054db94cdddd51d!2sHotel%20Berane!5e0!3m2!1sen!2s!4v1685204391912!5m2!1sen!2s"  height="470" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
<!-- Contact Section End -->

@endsection