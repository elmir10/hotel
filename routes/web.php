<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeadAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('frontend.index');
})->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:head_admin'])->group(function () {
    Route::get('/head_admin/dashboard', [HeadAdminController::class, 'HeadAdminDashboard'])->name('head_admin.dashboard');
    Route::get('/head_admin/logout', [HeadAdminController::class, 'HeadAdminDestroy'])->name('head_admin.logout');
    Route::get('/head_admin/profile', [HeadAdminController::class, 'HeadAdminProfile'])->name('head_admin.profile');
    Route::post('/head_admin/profile/store', [HeadAdminController::class, 'HeadAdminProfileStore'])->name('head_admin.profile.store');
    Route::get('/head_admin/picture', [HeadAdminController::class, 'HeadAdminPicture'])->name('head_admin.picture');
    Route::post('/head_admin/picture/store', [HeadAdminController::class, 'HeadAdminPictureStore'])->name('head_admin.picture.store');
    Route::get('/head_admin/change/password', [HeadAdminController::class, 'HeadAdminChangePassword'])->name('head_admin.change.password');
    Route::post('/head_admin/update/password', [HeadAdminController::class, 'HeadAdminUpdatePassword'])->name('head_admin.update.password');

    // Rooms
    Route::get('/head_admin/add/room', [HeadAdminController::class, 'HeadAdminAddRoom'])->name('head_admin.add.room');
    Route::post('/head_admin/store/room', [HeadAdminController::class, 'HeadAdminStoreRoom'])->name('head_admin.store.room');
    Route::get('/head_admin/room/add_images/{id}', [HeadAdminController::class, 'HeadAdminImagesView'])->name('head_admin.room.view');
    Route::post('/head_admin/store/room_image', [HeadAdminController::class, 'HeadAdminStoreRoomImage'])->name('head_admin.store.room_image');
    Route::get('/head_admin/all/rooms', [HeadAdminController::class, 'HeadAdminAllRooms'])->name('head_admin.all.rooms');
    Route::get('/head_admin/delete/room/{id}', [HeadAdminController::class, 'HeadAdminDeleteRoom'])->name('head_admin.delete.room');
    Route::get('/head_admin/edit/room/{id}', [HeadAdminController::class, 'HeadAdminEditRoom'])->name('head_admin.edit.room');
    Route::post('/head_admin/update/room', [HeadAdminController::class, 'HeadAdminUpdateRoom'])->name('head_admin.update.room');

    // Users
    Route::get('/head_admin/all_users', [HeadAdminController::class, 'HeadAdminAllUsers'])->name('head_admin.all_users');
    Route::get('/head_admin/activate_user/{id}', [HeadAdminController::class, 'HeadAdminActivateUser'])->name('head_admin.activate_user');
    Route::get('/head_admin/deactivate_user/{id}', [HeadAdminController::class, 'HeadAdminDeactivateUser'])->name('head_admin.deactivate_user');
    Route::get('/head_admin/delete_user/{id}', [HeadAdminController::class, 'HeadAdminDeleteUser'])->name('head_admin.delete_user');
    Route::get('/head_admin/edit_user/{id}', [HeadAdminController::class, 'HeadAdminEditUser'])->name('head_admin.edit_user');
    Route::post('/head_admin/update_user', [HeadAdminController::class, 'HeadAdminUpdateUser'])->name('head_admin.update_user');

    // Reservations
    Route::get('/head_admin/all_reservations', [HeadAdminController::class, 'HeadAdminAllReservations'])->name('head_admin.all_reservations');
    Route::get('/head_admin/all_reservations_', [HeadAdminController::class, 'HeadAdminAllReservationsNotification'])->name('head_admin.all_reservations_notification');
    Route::get('/head_admin/approve_reservation/{id}', [HeadAdminController::class, 'HeadAdminApproveReservation'])->name('head_admin.approve_reservation');

    // Messages
    Route::get('/head_admin/all_messages', [HeadAdminController::class, 'HeadAdminAllMessages'])->name('head_admin.all_messages');
    Route::get('/head_admin/all_messages_', [HeadAdminController::class, 'HeadAdminAllMessagesNotification'])->name('head_admin.all_messages_notification');
    Route::get('/head_admin/answer_message/{id}', [HeadAdminController::class, 'HeadAdminAnswerMessage'])->name('head_admin.answer_message');
    Route::post('/head_admin/send_answer', [HeadAdminController::class, 'HeadAdminSendAnswer'])->name('head_admin.send_answer');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/picture', [AdminController::class, 'AdminPicture'])->name('admin.picture');
    Route::post('/admin/picture/store', [AdminController::class, 'AdminPictureStore'])->name('admin.picture.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    // Reservations
    Route::get('/admin/all_reservations', [AdminController::class, 'AdminAllReservations'])->name('admin.all_reservations');
    Route::get('/admin/all_reservations_', [AdminController::class, 'AdminAllReservationsNotification'])->name('admin.all_reservations_notification');
    Route::get('/admin/approve_reservation/{id}', [AdminController::class, 'AdminApproveReservation'])->name('admin.approve_reservation');

    // Messages
    Route::get('/admin/all_messages', [AdminController::class, 'AdminAllMessages'])->name('admin.all_messages');
    Route::get('/admin/all_messages_', [AdminController::class, 'AdminAllMessagesNotification'])->name('admin.all_messages_notification');
    Route::get('/admin/answer_message/{id}', [AdminController::class, 'AdminAnswerMessage'])->name('admin.answer_message');
    Route::post('/admin/send_answer', [AdminController::class, 'AdminSendAnswer'])->name('admin.send_answer');

});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/logout', [UserController::class, 'UserDestroy'])->name('user.logout');
    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    Route::get('/reservations', [UserController::class, 'UserReservations'])->name('user.reservations');
    Route::get('/cancel/reservation/{id}', [UserController::class, 'CancelReservation'])->name('cancel.reservation');
});


Route::controller(HomeController::class)->group(function () {
    Route::get('/all/rooms', 'AllRooms')->name('all.rooms');
    Route::get('/about', 'About')->name('about');
    Route::get('/contact', 'Contact')->name('contact');
    Route::post('/contact/message', 'Message')->name('message');
    Route::get('/room/{id}', 'Room')->name('room');
    Route::match(['get', 'post'], '/check_available_rooms', 'CheckAvailableRooms')->name('check_available_rooms');
    Route::get('/all_available_rooms', 'AllAvailableRooms')->name('all.available.rooms');
    Route::get('/reserve/room/{id}', 'ReserveRoom')->name('reserve.room');
    Route::post('/reservation_request', 'ReservationRequest')->name('send.request');
});
