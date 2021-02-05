@extends('layout.welcome')


@section('contenido')

<div class="title m-b-md">
    Laravel
</div>

<div class="top-right links">
    <a href="{{ route('registrar') }}">Registrar</a>
</div>
<div class="form">
    <form action="{{ route('login') }}" method="post" role="form"  enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <div class="form-row">
            <label for="usuario">Usuario</label>
            <div class="col-md-6"><input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario"></div>
            <label for="password">Contraseña</label>
            <div class="col-md-1"><input type="password" name="password" class="form-control" id="password" placeholder="Contraseña"></div>
            @if ($errors->has('password'))
                <div class="validation">{{ $errors->first('password') }}</div>
            @endif
          </div>

      </div>
      <div class="text-center"><button type="submit">Entrar</button></div>
    </form>
  </div>
  <div class="links">
        <a href="{{ route('formRecover') }}">Contraseña Olvidada!!</a>
  </div>
@endsection
