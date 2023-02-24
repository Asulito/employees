@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('/empleados') }}" method="POST" enctype="multipart/form-data">
   @csrf
   @include('empleado.form', ['modo'=>'Crear'])
</form>
</div>
@endsection