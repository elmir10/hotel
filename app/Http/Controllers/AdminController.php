<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Message;
use Image;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminDestroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function AdminProfile(){
        $data = User::find(Auth::user()->id);
        return view('admin.admin_profile', compact('data'));
    }

    public function AdminProfileStore(Request $request){

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

        $notification = array(
            'message' => 'Uspješno izmijenjeni podaci.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminPicture(){
        $data = User::find(Auth::user()->id);
        return view('admin.admin_picture', compact('data'));
    }

    public function AdminPictureStore(Request $request){
        $request->validate([
            'photo' => 'required'
        ],
        [
            'photo.required' => 'Morate unijeti fotografiju.',
        ]
    );

        if($request->file('photo')){
            $file = $request->file('photo');
            if(User::findOrFail(Auth::user()->id)->photo){
                unlink('upload/head_admin_images/'.User::findOrFail(Auth::user()->id)->photo);
            }
            $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(160, 160)->save('upload/head_admin_images/'.$filename);
            User::find(Auth::user()->id)->update([
                'photo' => $filename,
                'updated_at' => Carbon::now(),
            ]);
        };

        $notification = array(
            'message' => 'Uspješno izmijenjena fotografija.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request){
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

    public function AdminAllReservations(){
        $reservations = Reservation::latest()->get();
        return view('admin.reservation.admin_all_reservations', compact('reservations'));
    }

    public function AdminAllReservationsNotification(){
        $reservations = Reservation::latest()->get();
        return view('admin.reservation.admin_all_reservations', compact('reservations'));
    }

    public function AdminApproveReservation($id){
        Reservation::findOrFail($id)->update([
            'processed' => '1',
            'processed_by' => Auth::user()->name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Uspješno odobrena rezervacija.',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }

    public function AdminAllMessages(){
        $messages = Message::latest()->get();
        return view('admin.message.admin_all_messages', compact('messages'));
    }

    public function AdminAllMessagesNotification(){
        $messages = Message::latest()->get();
        return view('admin.message.admin_all_messages', compact('messages'));
    }

    public function AdminAnswerMessage($id){
        $message_id = $id;
        return view('admin.message.admin_answer_message', compact('message_id'));
    }

    public function AdminSendAnswer(Request $request){
        $request->validate([
            'answer' => 'required',
        ],
        [
            'answer.required' => 'Morate unijeti poruku.',
        ]);

        Message::findOrFail($request->id)->update([
            'status' => '1',
            'answered_by' => Auth::user()->name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Uspješno odgovorena poruka.',
            'alert-type' => 'success'
        );
    
        return redirect()->route('admin.all_messages')->with($notification);

    }
}
