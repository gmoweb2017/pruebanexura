<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table="areas";
    protected $fillable=['nombre'];

    public function empleado()
    {
        return $this->hasMany(Emmpleado::class,'area_id','id');
    }

}
