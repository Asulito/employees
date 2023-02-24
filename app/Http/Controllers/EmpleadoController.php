<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['empleados'] = Empleado::paginate(1);
        return view('empleado.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [
            'nombre_empleado' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'correo_empleado' => 'required|email',
            'foto_empleado' => 'required|max:1000|mimes:jpg,png,jpeg'
        ];

        $message = [
            'required' => 'El :attribute es requerido',
            'foto_empleado.required' => 'La Foto es requerida'
        ];

        $this->validate($request, $fields, $message); 
        $datos_empleado = $request->except('_token');
        
        if ($request->file('foto_empleado')) {
            $datos_empleado['foto_empleado'] = $request->file('foto_empleado')->store('employee_photos', 'public');
        }
        Empleado::insert($datos_empleado);
        return redirect('empleados')->with('mensaje', 'Empleado agregado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($empleado)
    {
        $empleado = Empleado::findOrFail($empleado);
        return view('empleado.edit', compact('empleado'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $fields = [
            'nombre_empleado' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'correo_empleado' => 'required|email'
        ];

        $message = [
            'required' => 'El :attribute es requerido'
        ];

        if ($request->hasFile('foto_empleado')) {
            $fields = [
                'foto_empleado' => 'required|max:1000|mimes:jpg,png,jpeg'
            ];
    
            $message = [
                'required' => 'El tipo de foto es incorrecta'
            ];
        }
        $this->validate($request, $fields, $message); 
        $datos_empleado = $request->except('_token', '_method');
        
        if ($request->hasFile('foto_empleado')) {
            $empleado = Empleado::findOrFail($empleado->id);
            Storage::delete('public/'. $empleado->foto_empleado);
            $datos_empleado['foto_empleado'] = $request->file('foto_empleado')->store('employee_photos', 'public');
        }
        Empleado::where('id', $empleado->id)->update($datos_empleado);
        return redirect('empleados')->with('mensaje', 'Empleado actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado = Empleado::findOrFail($empleado->id);
        if(Storage::delete('public/'. $empleado->foto_empleado)){
            Empleado::destroy($empleado->id);
        }

        return redirect('empleados')->with('mensaje', 'Empleado borrado con exito!');
    }
}
