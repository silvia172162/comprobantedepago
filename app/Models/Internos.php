<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internos extends Model
{
    use HasFactory;
    protected $table='comprobante_interno';
    public $timestamps=true;
    protected $fillable=[
        'tipo',
        'fecha',
        'monto',
        'adjunto'
    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
    public function scopeBuscar($query,$dato)
    {
        return $query->where('tipo','LIKE',"%$dato%")
                    ->orWhere('monto','LIKE',"%$dato%");
    }
}
