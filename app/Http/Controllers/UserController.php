<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Reservation;
use Carbon\Carbon;

class UserController extends Controller
{
    public function UserDestroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function UserProfile(){
        $data = User::find(Auth::user()->id);
        return view('frontend.user.user_profile', compact('data'));
    }

    public function UserProfileStore(Request $request){

        $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Morate unijeti ime.',
                'phone.required' => 'Morate unijeti broj telefona.',
                'address.required' => 'Morate unijeti adresu.',
            ]
        );

        User::find(Auth::user()->id)->update([
            'name' => ucfirst($request->name),
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back();
    }

    public function UserChangePassword(){
        return view('frontend.user.user_change_password');
    }

    public function UserUpdatePassword(Request $request){
        $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ],
            [
                'old_password.required' => 'Morate unijeti trenutnu lozinku.',
                'new_password.required' => 'Morate unijeti novu lozinku.',
                'new_password.confirmed' => 'Potvrda nove lozinke nije ispravna.',
            ]
        );

        if(!Hash::check($request->old_password, Auth::user()->password)){
            return back()->with('error', 'Trenutna lozinka nije ispravna.');
        }

        User::findOrFail(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('status', 'Uspješno izmijenjena lozinka.');
    }

    public function UserReservations(){
        $reservations = Reservation::where('user_id', Auth::user()->id)
        ->where('processed', '0')
        ->where('cancelled', '0')
        ->latest()
        ->get();
        return view('frontend.reservation.reservations', compact('reservations'));
    }

    public function CancelReservation($id){
        $reservation = Reservation::findOrFail($id);
        if($reservation->user_id != Auth::user()->id){
            return back();
        } else {
            Reservation::findOrFail($id)->update([
                'cancelled' => '1',
                'processed' => '0',
                'updated_at' => Carbon::now(),
            ]);

            return back()->with('status', 'Uspješno otkazana rezervacija.');
        }
    }
}
