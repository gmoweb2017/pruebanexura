<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table="empleados";
    protected $fillable=['nombre','email','sexo','area_id','boletin','descripcion'];

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id','id');
    }

    public function empleadorol()
    {
        return $this->hasMany(EmmpleadoRol::class,'empleado_id','id');
    }

}
