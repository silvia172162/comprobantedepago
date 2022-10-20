<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table='roles';
    public $timestamps=true;
    protected $fillable=['Descripcion'];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
    public function scopeBuscar($query,$dato)
    {
        return $query->where('Descripcion','LIKE',"%$dato%");
    }

}
