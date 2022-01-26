<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Rol;

class RolController extends Controller
{
    public function getRol(Request $request)
    {
        $consulta = Rol::orderBy('id', 'asc')->get();

        return ['consulta' => $consulta];
    }
}
