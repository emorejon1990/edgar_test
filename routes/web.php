<?php

use Illuminate\Http\Request;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AppController@inicio')->name('index');

Route::post('/login', 'AppController@entrar')->name('login');
// Route::post('/login', 'AppController@entrar')->middleware('throttle:5,60')->name('login');

Route::get('/registrar', 'AppController@registrar')->name('registrar');

Route::post('/registro', 'AppController@registro')->name('registro');

Route::get('/perfil', 'AppController@logued')->middleware('verified')->name('perfil');

Route::get('/recov_pass', 'AppController@formRecover')->name('formRecover');

Route::post('/recov', 'AppController@recuperarP')->name('recover');


Route::group(['prefix' => 'perfil', 'middleware' => 'auth'], function() {
    Route::get('logout', 'AppController@logout')->name('logout');
    Route::post('act_perfil', 'AppController@act_perfil')->name('act_perfil');

});


//para enviarle el correo
Route::get('/email/verify', function () {
    return view('registrado');
})->middleware('auth')->name('verification.notice');

//cuando da click en la verificacion
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

//Reenviar correo
Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return view('registrado')->with('message', 'La url de verificación se ha enviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

