@extends('layout.welcome')


@section('contenido')

<div class="title m-b-md">
    Laravel
</div>
usted se ha registrado satisfatoriamente, revise su correo para activar su cuenta!!

<a href="{{route('verification.send')}}">Reenviar correo</a>

@endsection
