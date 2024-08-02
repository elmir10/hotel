<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Picture;
use App\Models\Message;
use App\Models\Reservation;
use Image;
use Carbon\Carbon;

class HeadAdminController extends Controller
{
    public function HeadAdminDashboard(){
        return view('head_admin.index');
    }

    public function HeadAdminDestroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function HeadAdminProfile(){
        $data = User::find(Auth::user()->id);
        return view('head_admin.head_admin_profile', compact('data'));
    }

    public function HeadAdminProfileStore(Request $request){

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

    public function HeadAdminPicture(){
        $data = User::find(Auth::user()->id);
        return view('head_admin.head_admin_picture', compact('data'));
    }

    public function HeadAdminPictureStore(Request $request){
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

    public function HeadAdminChangePassword(){
        return view('head_admin.head_admin_change_password');
    }

    public function HeadAdminUpdatePassword(Request $request){
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

    public function HeadAdminAddRoom(){
        $types = RoomType::latest()->get();
        return view('head_admin.room.head_admin_add_room', compact('types'));
    }

    public function HeadAdminStoreRoom(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'number' => 'required',
            'type_id' => 'required',
            'size' => 'required',
            'price' => 'required',
            'capacity' => 'required',
            'description' => 'required',
        ],
        [
            'name.required' => 'Morate unijeti naziv sobe.',
            'name.min' => 'Naziv mora sadržati najmanje 3 slova.',
            'number.required' => 'Morate unijeti broj sobe.',
            'type_id.required' => 'Morate unijeti tip sobe.',
            'size.required' => 'Morate unijeti površinu sobe.',
            'price.required' => 'Morate unijeti cijenu (jedna noć) sobe.',
            'capacity.required' => 'Morate unijeti broj ljudi koji mogu prenoćiti zajedno.',
            'description.required' => 'Morate unijeti opis sobe.',
        ]);

        $room_id = Room::insertGetId([
            'name' => $request->name,
            'number' => $request->number,
            'type_id' => $request->type_id,
            'size' => $request->size,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'wifi' => $request->wifi,
            'air_condition' => $request->air_condition,
            'balcony' => $request->balcony,
            'sea_view' => $request->sea_view,
            'minibar' => $request->minibar,
            'strongbox' => $request->strongbox,
            'tv' => $request->tv,
            'sofa' => $request->sofa,
            'worktable' => $request->worktable,
            'parking' => $request->parking,
            'spa_and_wellness' => $request->spa_and_wellness,
            'breakfast' => $request->breakfast,
            'no_smoking' => $request->no_smoking,
            'crib' => $request->crib,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('head_admin.room.view', $room_id);

    }

    public function HeadAdminImagesView($id){
        return view('head_admin.room.head_admin_add_images', compact('id'));
    }

    public function HeadAdminStoreRoomImage(Request $request){

        $request->validate([
            'main_photo' => 'required',
        ],
        [
            'main_photo.required' => 'Morate unijeti udarnu fotografiju.',
        ]
        );

        $image = $request->file('main_photo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(470, 600)->save('upload/room_images/main/'.$name_gen);

        Picture::insert([
            'room_id' => $request->room_id,
            'name' => $name_gen,
            'type' => 'main',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if($request->file('other_photos')){
            $images = $request->file('other_photos');
            foreach($images as $img){
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800)->save('upload/room_images/others/'.$make_name);
                
                Picture::insert([
                    'room_id' => $request->room_id,
                    'name' => $make_name,
                    'type' => 'other',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        
        
        $notification = array(
            'message' => 'Uspješno dodana soba.',
            'alert-type' => 'success'

        );

        return redirect()->route('head_admin.all.rooms')->with($notification);

    }

    public function HeadAdminAllRooms(){
        $rooms = Room::latest()->get();
        return view('head_admin.room.head_admin_all_rooms', compact('rooms'));
    }

    public function HeadAdminDeleteRoom($id){

        $room_images = Picture::where('room_id', $id)->get();

        foreach($room_images as $img){
            if(file_exists('upload/room_images/main/'.$img->name)){
                unlink('upload/room_images/main/'.$img->name);        
            } elseif (file_exists('upload/room_images/others/'.$img->name)){
                unlink('upload/room_images/others/'.$img->name);
            }
        }

        Picture::where('room_id', $id)->delete();

        Room::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Soba uspješno izbrisana.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } 

    public function HeadAdminEditRoom($id){
        $room = Room::findOrFail($id);
        $types = RoomType::latest()->get();
        return view('head_admin.room.head_admin_edit_room', compact('room', 'types'));
    }

    public function HeadAdminUpdateRoom(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'number' => 'required',
            'type_id' => 'required',
            'size' => 'required',
            'price' => 'required',
            'capacity' => 'required',
            'description' => 'required',
        ],
        [
            'name.required' => 'Morate unijeti naziv sobe.',
            'name.min' => 'Naziv mora sadržati najmanje 3 slova.',
            'number.required' => 'Morate unijeti broj sobe.',
            'type_id.required' => 'Morate unijeti tip sobe.',
            'size.required' => 'Morate unijeti površinu sobe.',
            'price.required' => 'Morate unijeti cijenu (jedna noć) sobe.',
            'capacity.required' => 'Morate unijeti broj ljudi koji mogu prenoćiti zajedno.',
            'description.required' => 'Morate unijeti opis sobe.',
        ]);

        Room::findOrFail($request->id)->update([
            'name' => $request->name,
            'number' => $request->number,
            'type_id' => $request->type_id,
            'size' => $request->size,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'wifi' => $request->wifi,
            'air_condition' => $request->air_condition,
            'balcony' => $request->balcony,
            'sea_view' => $request->sea_view,
            'minibar' => $request->minibar,
            'strongbox' => $request->strongbox,
            'tv' => $request->tv,
            'sofa' => $request->sofa,
            'worktable' => $request->worktable,
            'parking' => $request->parking,
            'spa_and_wellness' => $request->spa_and_wellness,
            'breakfast' => $request->breakfast,
            'no_smoking' => $request->no_smoking,
            'crib' => $request->crib,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Uspješno promijenjeni podaci sobi.',
            'alert-type' => 'success'

        );

        return redirect()->route('head_admin.all.rooms')->with($notification);
    }


    public function HeadAdminAllUsers(){
        $users = User::latest()->get();
        return view('head_admin.user.head_admin_all_users', compact('users'));
    }

    public function HeadAdminActivateUser($id){
        User::findOrFail($id)->update([
            'status' => 'active',
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Uspješno aktiviran korisnik.',
            'alert-type' => 'success'

        );

        return redirect()->route('head_admin.all_users')->with($notification);        
    }


    public function HeadAdminDeactivateUser($id){
        User::findOrFail($id)->update([
            'status' => 'inactive',
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Uspješno deaaktiviran korisnik.',
            'alert-type' => 'success'

        );

        return redirect()->route('head_admin.all_users')->with($notification);        
    }

    public function HeadAdminDeleteUser($id){
        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Uspješno izbrisan korisnik.',
            'alert-type' => 'success'

        );

        return redirect()->route('head_admin.all_users')->with($notification);        
    }

    public function HeadAdminEditUser($id){
        $data = User::findOrFail($id);
        return view('head_admin.user.head_admin_edit_user', compact('data'));
    }

    public function HeadAdminUpdateUser(Request $request){
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

    User::find($request->id)->update([
        'name' => ucfirst($request->name),
        'phone' => $request->phone,
        'address' => $request->address,
        'role' => $request->role,
        'updated_at' => Carbon::now(),
    ]);

    $notification = array(
        'message' => 'Uspješno izmijenjeni podaci.',
        'alert-type' => 'success'
    );

    return redirect()->route('head_admin.all_users')->with($notification);
    }

    public function HeadAdminAllReservations(){
        $reservations = Reservation::latest()->get();
        return view('head_admin.reservation.head_admin_all_reservations', compact('reservations'));
    }


    public function HeadAdminAllReservationsNotification(){
        $reservations = Reservation::latest()->get();
        return view('head_admin.reservation.head_admin_all_reservations', compact('reservations'));
    }

    public function HeadAdminApproveReservation($id){
        Reservation::findOrFail($id)->update([
            'processed' => '1',
            'processed_by' => Auth::user()->name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Uspješno odobrena rezervacija.',
            'alert-type' => 'success'
        );
    
        return redirect()->route('head_admin.all_reservations')->with($notification);
    }

    public function HeadAdminAllMessages(){
        $messages = Message::latest()->get();
        return view('head_admin.message.head_admin_all_messages', compact('messages'));
    }

    public function HeadAdminAllMessagesNotification(){
        $messages = Message::latest()->get();
        return view('head_admin.message.head_admin_all_messages', compact('messages'));
    }

    public function HeadAdminAnswerMessage($id){
        $message_id = $id;
        return view('head_admin.message.head_admin_answer_message', compact('message_id'));
    }

    public function HeadAdminSendAnswer(Request $request){
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
    
        return redirect()->route('head_admin.all_messages')->with($notification);

    }
}
