@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/empleados/'.$empleado->id) }}" method="POST" enctype="multipart/form-data">
   @csrf
   {{ method_field('PUT') }}
   @include('empleado.form', ['modo'=>'Editar'])
</form>
</div>
@endsection