<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebMaster extends Model
{
    protected $table='users';
    public $timestamps=true;
    protected $fillable=['Rol','Dni','Nombres','email','email_verified_at','password','remember_token','Estado','foto','session_id'];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
    public function scopeBuscar($query,$dato)
    {
        return $query->where('Dni','LIKE',"%$dato%")
        			->orWhere('Nombres','LIKE',"%$dato%");
    }
}
