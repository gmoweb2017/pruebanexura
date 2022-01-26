<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoRol extends Model
{
    use HasFactory;

    protected $table="empleado_rol";
    protected $fillable=['empleado_id','rol_id'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'empleado_id','id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class,'rol_id','id');
    }
}
