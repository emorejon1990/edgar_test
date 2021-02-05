@extends('layout.welcome')


@section('contenido')

<div class="title m-b-md">
    Laravel
</div>
<div class="form">
    <form action="{{ route('registro') }}" method="post" role="form"  enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <div class="form-row">

            <label for="usuario">Usuario</label>
            <div class="col-md-6"><input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario"></div>

            <label for="password">Contraseña</label>
            <div class="col-md-1"><input type="password" name="password" class="form-control" id="password" placeholder="Contraseña"></div>

            <label for="email">Correo Electrónico</label>
            <div class="col-md-1"><input type="email" name="email" class="form-control" id="email" placeholder="Correo Electrónico"></div>

            @if ($errors->has('password'))
                <div class="validation">{{ $errors->first('password') }}</div>
            @endif
          </div>

      </div>
      <div class="text-center"><button type="submit">Registrar</button></div>
    </form>
  </div>
@endsection
