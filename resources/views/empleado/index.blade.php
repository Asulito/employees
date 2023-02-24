@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-success" role="alert">
   <strong>Ok!</strong> {{ Session::get('mensaje') }}
</div>
@endif
<button type="button" class="btn btn-primary" onclick="window.location.href = '{{ url('/empleados/create') }}'">Agregar Nuevo</button>
<div class="table-responsive">
   <table class="table table-dark">
      <thead>
         <tr>
            <th>#</th>
            <th scope="col">Foto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>
         </tr>
      </thead>
      <tbody>
         @foreach($empleados as $empleado)
         <tr class="">
            <td>{{ $empleado->id }} </td>
            <td>
               <img width="100" src="{{ asset('storage').'/'.$empleado->foto_empleado }}" class="img-fluid rounded-top" alt="">
            </td>
            <td>{{ $empleado->nombre_empleado }}</td>
            <td>{{ $empleado->apellido_paterno }}</td>
            <td>{{ $empleado->apellido_materno }}</td>
            <td>{{ $empleado->correo_empleado }}</td>
            <td>
               <a href="{{ url('/empleados/'.$empleado->id.'/edit') }}">
                  <button type="button" class="btn btn-primary">Editar</button>
               </a>
               <form action="{{ url('/empleados/'.$empleado->id) }}" method="post">
                  @csrf
                  {{ method_field('DELETE') }}
                  <button type="submit" onclick="return confirm('¿Estas seguro de querer borrar?')" class="btn btn-danger">Borrar</button>
               </form>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
   {!! $empleados->links() !!}
</div>

</div>
@endsection