<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\RecoverPassMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class AppController extends Controller
{
    public function inicio()
	{

		return view('home');
    }

    public function entrar(Request $request)
	{
        $this->validate(request(), [
            'usuario' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('usuario', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $date = new DateTime();
            $user = User::where('usuario', '=', $request->get('usuario'))->firstOrFail();
            $user->ultima = $date;
            $user->save();

            return redirect()->intended('perfil');
        }

        return redirect()->route('index');

    }

    public function registrar()
	{
        return view('registrar');
    }

    public function registro(Request $request)
	{
        $this->validate(request(), [
            'usuario' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new User();
        $user->password = Hash::make($request->get('password'));
        $user->email = $request->get('email');
        $user->usuario = $request->get('usuario');
        $user->save();

        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('verification.notice');

    }

    public function logued(Request $request)
	{
        $user = Auth::user();
        return view('logued', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function act_perfil(Request $request)
	{
        $request->validate([
            'nombre' => 'nullable|max:120',
            'apellidos' => 'nullable|max:120',
            'direccion' => 'nullable|max:120',
            'nat_fecha' => 'nullable|date',
        ]);

        $user = Auth::user();
        $user->nombre = $request->get('nombre');
        $user->apellidos = $request->get('apellidos');
        $user->direccion = $request->get('direccion');
        $user->fecha_nacimiento = $request->get('nat_fecha');
        $user->save();

        return redirect()->intended('perfil');

    }
    public function formRecover()
    {
        return view('formRecover');
    }

    public function recuperarP(Request $request)
    {
        $pass = Str::random(12);
        $user = User::where('usuario', '=', $request->get('usuario'))->firstOrFail();
        if ($user) {
            $user->password = Hash::make($pass);
            $user->save();
            Mail::to($user->email)->send(new RecoverPassMail($user, $pass));
        }
        return redirect()->intended('index');

    }
}
