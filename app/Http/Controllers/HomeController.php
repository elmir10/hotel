<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Message;
use App\Models\Picture;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function AllRooms(){
        $rooms = Room::latest()->paginate(3);
        return view('frontend.room.all_rooms', compact('rooms'));
    }

    public function About(){
        return view('frontend.about.about');
    }

    public function Contact(){
        return view('frontend.contact.contact');
    }

    public function Message(Request $request){
        if(Auth::user()){
            $request->validate([
                'message' => 'required',
            ],
            [
                'message.required' => 'Molimo unesite poruku.',
            ]
        );
        Message::insert([
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'text' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('status', 'Uspješno poslana poruka.');

        } else {
            $request->validate([
                'name' => 'required|string|min:5',
                'email' => 'required',
                'message' => 'required',
            ],
            [
                'name.required' => 'Molimo unesite Vaše ime i prezime.',
                'name.min' => 'Ime i prezime mora sadržati najmanje 5 karaktera.',
                'email.required' => 'Molimo unesite email.',
                'message.required' => 'Molimo unesite poruku.',
            ]
            );

            Message::insert([
                'name' => $request->name,
                'email' => $request->email,
                'text' => $request->message,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return back()->with('status', 'Uspješno poslana poruka.');
        }

    }

    public function Room($id){
        $room = Room::findOrFail($id);
        $pictures = Picture::where('room_id', $id)->where('type', 'other')->latest()->get();
        return view('frontend.room.room', compact('room', 'pictures'));
    }

    public function CheckAvailableRooms(Request $request){
        $request->validate([
            'date_in' => 'required',
            'date_out' => 'required',
            'guests' => 'required',
        ], [
            'date_in.required' => 'Molimo unesite datum dolaska.',
            'date_out.required' => 'Molimo unesite datum odlaska.',
            'guests.required' => 'Molimo izaberite broj osoba.',
        ]);

        $date_in = $request->date_in;
        $formatted_date_in = null;

        try {
            $parsed_date = Carbon::createFromFormat('d M, Y', $date_in);

            if ($parsed_date instanceof Carbon) {
                $formatted_date_in = $parsed_date->format('Y-m-d');
            }
        } catch (\Throwable $e) {

        }

        if ($formatted_date_in === null) {
            return back()->with('error', 'Datum dolaska nije ispravno unesen.');
        }

        $date_out = $request->date_out;
        $formatted_date_out = null;

        try {
            $parsed_date_out = Carbon::createFromFormat('d M, Y', $date_out);

            if ($parsed_date_out instanceof Carbon) {
                $formatted_date_out = $parsed_date_out->format('Y-m-d');
            }
        } catch (\Throwable $e) {
            
        }

        if ($formatted_date_out === null) {
            return back()->with('error', 'Datum odlaska nije ispravno unesen.');
        }

        if ($formatted_date_in > $formatted_date_out) {
            return back()->with('error', 'Datum dolaska ne može biti veći od datuma odlaska.');
        }

        $reservations = Reservation::where('processed', '1')
            ->where(function ($query) use ($formatted_date_in, $formatted_date_out) {
                $query->where(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('arriving_date', '>=', $formatted_date_in)
                        ->where('arriving_date', '<', $formatted_date_out);
                })->orWhere(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('departure_date', '>', $formatted_date_in)
                        ->where('departure_date', '<=', $formatted_date_out);
                })->orWhere(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('arriving_date', '<=', $formatted_date_in)
                        ->where('departure_date', '>=', $formatted_date_out);
                });
            })
            ->pluck('room_id');

        session(['reservations' => $reservations->toArray()]);

        return redirect()->route('all.available.rooms');
    }

    public function AllAvailableRooms(){
        $reservations = session('reservations');
        $rooms = Room::whereNotIn('id', $reservations)->latest()->paginate(1);
        return view('frontend.room.all_available_rooms', compact('rooms'));
    }

    public function ReserveRoom($id){
        $room = Room::findOrFail($id);
        return view('frontend.room.reserve_room', compact('room'));
    }

    public function ReservationRequest(Request $request){
        if(Auth::user()){
            $request->validate([
                'date_in' => 'required',
                'date_out' => 'required',
            ],
            [
                'date_in.required' => 'Molimo unesite datum dolaska.',
                'date_out.required' => 'Molimo unesite datum odlaska.',
            ]
        );

        if (Carbon::createFromFormat('d M, Y', $request->date_in) !== false) {
            $formatted_date_in = Carbon::createFromFormat('d M, Y', $request->date_in)->format('Y-m-d');
        } else {
            return back()->with('error', 'Datum dolaska nije ispravno unesen.');
        }

        if (Carbon::createFromFormat('d M, Y', $request->date_out) !== false) {
            $formatted_date_out = Carbon::createFromFormat('d M, Y', $request->date_out)->format('Y-m-d');
        } else {
            return back()->with('error', 'Datum odlaska nije ispravno unesen.');
        }

        if ($formatted_date_in > $formatted_date_out) {
            return back()->with('error', 'Datum dolaska ne može biti veći od datuma odlaska.');
        }

        $reservations = Reservation::where('processed', '1')
            ->where(function ($query) use ($formatted_date_in, $formatted_date_out) {
                $query->where(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('arriving_date', '>=', $formatted_date_in)
                        ->where('arriving_date', '<', $formatted_date_out);
                })->orWhere(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('departure_date', '>', $formatted_date_in)
                        ->where('departure_date', '<=', $formatted_date_out);
                })->orWhere(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('arriving_date', '<=', $formatted_date_in)
                        ->where('departure_date', '>=', $formatted_date_out);
                });
            })
            ->pluck('room_id');

        if(in_array($request->room_id, $reservations->all())){
            return back()->with('error', 'Nažalost, taj termin je zauzet.');
        } else {
        
            $days = Carbon::parse($request->input('date_in'))->diffInDays(Carbon::parse($request->input('date_out')));

            Reservation::insert([
                'room_id' => $request->room_id,
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'phone' => Auth::user()->phone,
                'email' => Auth::user()->email,
                'address' => Auth::user()->address,
                'price' => Room::findOrFail($request->room_id)->price * $days,
                'arriving_date' => $formatted_date_in,
                'departure_date' => $formatted_date_out,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    
            return back()->with('status', 'Uspješno poslan zahtjev za rezervaciju. Bićete obaviješteni u najkraćem roku o svemu.');
        }
        

        } else {
            $request->validate([
                'name' => 'required|string|min:5',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'date_in' => 'required',
                'date_out' => 'required',
            ],
            [
                'name.required' => 'Molimo unesite Vaše ime i prezime.',
                'name.min' => 'Ime i prezime moraju sadržati najmanje 5 karaktera.',
                'email.required' => 'Molimo unesite email.',
                'address.required' => 'Molimo unesite adresu.',
                'phone.required' => 'Molimo unesite broj telefona.',
                'date_in.required' => 'Molimo unesite datum dolaska.',
                'date_out.required' => 'Molimo unesite datum odlaska.',
            ]
            );

            if (Carbon::createFromFormat('d M, Y', $request->date_in) !== false) {
                $formatted_date_in = Carbon::createFromFormat('d M, Y', $request->date_in)->format('Y-m-d');
            } else {
                return back()->with('error', 'Datum dolaska nije ispravno unesen.');
            }
    
            if (Carbon::createFromFormat('d M, Y', $request->date_out) !== false) {
                $formatted_date_out = Carbon::createFromFormat('d M, Y', $request->date_out)->format('Y-m-d');
            } else {
                return back()->with('error', 'Datum odlaska nije ispravno unesen.');
            }
    
            if ($formatted_date_in > $formatted_date_out) {
                return back()->with('error', 'Datum dolaska ne može biti veći od datuma odlaska.');
            }

            $reservations = Reservation::where('processed', '1')
            ->where(function ($query) use ($formatted_date_in, $formatted_date_out) {
                $query->where(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('arriving_date', '>=', $formatted_date_in)
                        ->where('arriving_date', '<', $formatted_date_out);
                })->orWhere(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('departure_date', '>', $formatted_date_in)
                        ->where('departure_date', '<=', $formatted_date_out);
                })->orWhere(function ($query) use ($formatted_date_in, $formatted_date_out) {
                    $query->where('arriving_date', '<=', $formatted_date_in)
                        ->where('departure_date', '>=', $formatted_date_out);
                });
            })
            ->pluck('room_id');

            if(in_array($request->room_id, $reservations->all())){
                return back()->with('error', 'Nažalost, taj termin je zauzet.');
            } else {
            
                $days = Carbon::parse($request->input('date_in'))->diffInDays(Carbon::parse($request->input('date_out')));
    
                Reservation::insert([
                    'room_id' => $request->room_id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'price' => Room::findOrFail($request->room_id)->price * $days,
                    'arriving_date' => $formatted_date_in,
                    'departure_date' => $formatted_date_out,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        
                return back()->with('status', 'Uspješno poslan zahtjev za rezervaciju. Bićete obaviješteni u najkraćem roku o svemu.');
            }
        }

    }

}
