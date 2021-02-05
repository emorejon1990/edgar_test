@extends('layout.welcome')


@section('contenido')

<div class="title m-b-md">
    Laravel
</div>
<div class="top-right links">
    <a href="{{ route('logout') }}">Salir</a>
</div>
"Logueado"
{{-- {{ $yo }} --}}
<p>Usuario: {{ $user->usuario }}</p>
<p>Correo: {{ $user->email }}</p>

<div class="form">
    <form action="{{ route('act_perfil') }}" method="post" role="form"  enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <div class="form-row">

            <label for="nombre">Nombres</label>
            <div class="col-md-6"><input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombres" value="@if($user->nombre){{ $user->nombre }}@endif"></div>

            <label for="apellidos">Apellidos</label>
            <div class="col-md-6"><input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos" value="@if($user->apellidos){{ $user->apellidos }}@endif"></div>

            <label for="direccion">Dirección</label>
            <div class="col-md-6"><input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección" value="@if($user->direccion){{ $user->direccion }}@endif"></div>

            <label for="nat_fecha">Fecha de Nacimiento</label>
            <div class="col-md-6"><input type="date" name="nat_fecha" class="form-control" id="nat_fecha" placeholder="Fecha de Nacimiento" value="@if($user->fecha_nacimiento){{ $user->fecha_nacimiento }}@endif"></div>
          </div>
            @if ($errors->any())
                <div class="validation">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

      </div>
      <div class="text-center"><button type="submit">Guardar</button></div>
    </form>
  </div>
@endsection
