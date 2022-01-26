<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\Area;


class AreaController extends Controller
{
    public function getArea(Request $request)
    {
        $consulta = Area::orderBy('id', 'asc')->get();

        return ['consulta' => $consulta];
    }
}
