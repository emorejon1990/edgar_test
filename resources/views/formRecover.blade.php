@extends('layout.welcome')


@section('contenido')

<div class="title m-b-md">
    Laravel
</div>
Recuperar Contraseña
<div class="form">
    <form action="{{ route('recover') }}" method="post" role="form"  enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <div class="form-row">
            <label for="usuario">Usuario</label>
            <div class="col-md-6"><input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario"></div>
            @if ($errors->has('password'))
                <div class="validation">{{ $errors->first('password') }}</div>
            @endif
          </div>

      </div>
      <div class="text-center"><button type="submit">Enviar</button></div>
    </form>
  </div>
@endsection
