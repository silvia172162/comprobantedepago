<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
    protected $table='proyectos';
    public $timestamps=true;
    protected $fillable=[
        'numero',
        'fecha',
        'reg_siaf',
        'dependencia',
        'concepto',
        'observacion',
        'proyecto',
        'monto'
    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
    public function scopeBuscar($query,$dato)
    {
        return $query->where('numero','LIKE',"%$dato%")
                    ->orWhere('concepto','LIKE',"%$dato%");
    }
}
