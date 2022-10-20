<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobantes extends Model
{
    use HasFactory;
    protected $table='comprobante';
    public $timestamps=true;
    protected $fillable=[
        'id_proyecto',
        'numero',
        'adjunto'    ];
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];
    public function scopeBuscar($query,$dato)
    {
        return $query->where('numero','LIKE',"%$dato%");
    }
}
