<div class="mb-3">
   <label for="nombre_empleado" class="form-label">Nombre</label>
   <input type="text" class="form-control" name="nombre_empleado" id="nombre_empleado"
      value="{{ isset($empleado->nombre_empleado) ? $empleado->nombre_empleado : old('nombre_empleado') }}" aria-describedby="helpId"
      placeholder="">
	<?php foreach ($errors->get('nombre_empleado') as $message): ?>
   <small id="helpId" class="form-text text-muted">
			{{ $message }}
   </small>
	<?php endforeach; ?>
</div>
<div class="mb-3">
   <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
   <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno"
      value="{{ isset($empleado->apellido_paterno) ? $empleado->apellido_paterno : old('apellido_paterno') }}" aria-describedby="helpId"
      placeholder="">
	<?php foreach ($errors->get('apellido_paterno') as $message): ?>
	<small id="helpId" class="form-text text-muted">
			{{ $message }}
	</small>
	<?php endforeach; ?>
</div>
<div class="mb-3">
   <label for="apellido_materno" class="form-label">Apellido Materno</label>
   <input type="text" class="form-control" name="apellido_materno" id="apellido_materno"
      value="{{ isset($empleado->apellido_materno) ? $empleado->apellido_materno : old('apellido_materno') }}" aria-describedby="helpId"
      placeholder="">
   <?php foreach ($errors->get('apellido_materno') as $message): ?>
   <small id="helpId" class="form-text text-muted">
			{{ $message }}
   </small>
	<?php endforeach; ?>
</div>
<div class="mb-3">
   <label for="correo_empleado" class="form-label">Correo</label>
   <input type="text" class="form-control" name="correo_empleado" id="correo_empleado"
      value="{{ isset($empleado->correo_empleado) ? $empleado->correo_empleado : old('correo_empleado') }}" aria-describedby="helpId"
      placeholder="">
   <?php foreach ($errors->get('correo_empleado') as $message): ?>
   <small id="helpId" class="form-text text-muted">
			{{ $message }}
   </small>
	<?php endforeach; ?>
</div>
<div class="mb-3">
   <label for="foto_empleado" class="form-label">Foto</label>
   @if(isset($empleado->foto_empleado))
   <img width="100" src="{{ asset('storage').'/'.$empleado->foto_empleado }}" class="img-fluid rounded-top" alt="">
   @endif
   <input type="file" class="form-control" name="foto_empleado" id="foto_empleado" aria-describedby="helpId"
      placeholder="">
   <?php foreach ($errors->get('foto_empleado') as $message): ?>
   <small id="helpId" class="form-text text-muted">
			{{ $message }}
   </small>
	<?php endforeach; ?>
</div>
<button type="submit" class="btn btn-success">{{ $modo }} Empleado</button>

<button type="button" class="btn btn-primary"
   onclick="window.location.href = '{{ url('/empleados') }}'">Regresar</button>