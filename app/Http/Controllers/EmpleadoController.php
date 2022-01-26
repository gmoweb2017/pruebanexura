<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Empleado;
use App\Models\EmpleadoRol;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;


        $filtro1 = $request->filtro1;
        $filtro2 = $request->filtro2;
        $filtro3 = $request->filtro3;
        $filtro4 = $request->filtro4;


        $listado = Empleado::orderBy('id', 'asc')->with("area")->paginate(20);


        return [
            'pagination' => [
                'total'        => $listado->total(),
                'current_page' => $listado->currentPage(),
                'per_page'     => $listado->perPage(),
                'last_page'    => $listado->lastPage(),
                'from'         => $listado->firstItem(),
                'to'           => $listado->lastItem(),
            ],
            'listado' => $listado
        ];
    }

    public function store(Request $request)
    {

        $array1= $request->arrayRol;


        $i=0;
        foreach($array1 as $ep=>$detres){
            if($detres['answer']){
                $i= $i+1;
            }
        }
        //dd($i);
        $validator = Validator::make([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'sexo' => $request->sexo,
            'area' => $request->area,
            'descripcion' => $request->descripcion,
            'boletin' => $request->boletin,
            'rol' => $i,
        ], [
            'nombre' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|max:255|email:rfc,dns',
            'sexo' => 'required|max:1',
            'area' => 'required',
            'descripcion' => 'required',
            'boletin' => 'required',
            'rol' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return  response()->json([
                'nombre' => $validator->errors()->first('nombre'),
                'sexo' => $validator->errors()->first('sexo'),
                'email' => $validator->errors()->first('email'),
                'area' => $validator->errors()->first('area'),
                'descripcion' => $validator->errors()->first('descripcion'),
                'boletin' => $validator->errors()->first('boletin'),
                'rol' => $validator->errors()->first('rol'),
            ],422);
        }


        $valida = Empleado::where('email','=',$request->email)->count();

        if($valida>0){
            $data = array(
                'message' => 'Ya existe un registro con este correo.',
                'status' =>'warning',
                'state' => 'warning',
                'icon' => 'warning',
                'title' => 'Registro duplicado',
                'url'=>'#',
                'code' => 200
            );
        }else{

            if($request->boletin){
                $boletin=1;
            }else{
                $boletin=0;
            }


           $empleado= Empleado::create([
                'nombre'=>$request->nombre,
                'email'=>$request->email,
                'sexo'=>$request->sexo,
                'area_id'=>$request->area,
                'descripcion'=>$request->descripcion,
                'boletin'=>$boletin
            ]);

            foreach($array1 as $ep=>$detres){
                if($detres['answer']){
                    $insert = new EmpleadoRol();
                    $insert->empleado_id = $empleado->id;
                    $insert->rol_id = $detres['id'];
                    $insert->save();

                }
            }

            $data = array(
                'message' => 'Registro de empleado exitoso.',
                'status' =>'success',
                'state' => 'success',
                'icon' => 'success',
                'title' => 'Registro insertado',
                'url'=>'#',
                'code' => 200
            );

        }

         return response()->json($data,200);


    }


    public function update(Request $request)
    {

        $array1= $request->arrayRol;
        $i=0;
        foreach($array1 as $ep=>$detres){
            if($detres['answer']){
                $i= $i+1;
            }
        }
        //dd($i);
        $validator = Validator::make([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'sexo' => $request->sexo,
            'area' => $request->area,
            'descripcion' => $request->descripcion,
            'boletin' => $request->boletin,
            'rol' => $i,
        ], [
            'nombre' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|max:255|email:rfc,dns',
            'sexo' => 'required|max:1',
            'area' => 'required',
            'descripcion' => 'required',
            'boletin' => 'required',
            'rol' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return  response()->json([
                'nombre' => $validator->errors()->first('nombre'),
                'sexo' => $validator->errors()->first('sexo'),
                'email' => $validator->errors()->first('email'),
                'area' => $validator->errors()->first('area'),
                'descripcion' => $validator->errors()->first('descripcion'),
                'boletin' => $validator->errors()->first('boletin'),
                'rol' => $validator->errors()->first('rol'),
            ],422);
        }
        if($request->boletin){
            $boletin=1;
        }else{
            $boletin=0;
        }


           $empleado= Empleado::findOrFail($request->id_empleado);
           $empleado->nombre = $request->nombre;
           $empleado->email = $request->email;
           $empleado->sexo = $request->sexo;
           $empleado->area_id = $request->area;
           $empleado->descripcion = $request->descripcion;
           $empleado->boletin = $boletin;
           $empleado->save();

            $borra = EmpleadoRol::where('empleado_id','=',$request->id_empleado)->delete();

            foreach($array1 as $ep=>$detres){
                if($detres['answer']){
                    $insert = new EmpleadoRol();
                    $insert->empleado_id = $request->id_empleado;
                    $insert->rol_id = $detres['id'];
                    $insert->save();

                }
            }

            $data = array(
                'message' => 'Registro de empleado actualizado.',
                'status' =>'success',
                'state' => 'success',
                'icon' => 'success',
                'title' => 'Registro actualizado',
                'url'=>'#',
                'code' => 200
            );



         return response()->json($data,200);


    }

    public function delete(Request $request){
        $borra = EmpleadoRol::where('empleado_id','=',$request->id)->delete();
        $borraEmpleado = Empleado::whereId($request->id)->delete();

        $data = array(
            'message' => 'Registro de empleado eliminado.',
            'status' =>'success',
            'state' => 'success',
            'icon' => 'success',
            'title' => 'Registro eliminado',
            'url'=>'#',
            'code' => 200
        );
        return response()->json($data,200);
    }
}
