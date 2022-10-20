<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Date;
use App\Roles;
use App\Models\Comprobantes;
use App\Models\Proyectos;

class FuncionesController extends Controller
{
    
    public function cmb_roles()
    {
        $dt=Roles::orderby('Descripcion','ASC')->get();
        $cmb='';
        foreach ($dt as $rol) {
           $cmb.='<option value="'.$rol->id.'">'.$rol->Descripcion.'</option>';
        }
        return $cmb;
    }

    public function nom_rol($id)
    {
        $dt=Roles::find($id);
        $dato=$dt->Descripcion;
        return $dato;
    }

    public function adjuntos_proy($id_proy)
    {
        $adjs='';
        $dt=Comprobantes::where('id_proyecto',$id_proy)->get();
        foreach ($dt as $dato) {
           $docu=$dato->adjunto;
           $url_adj=asset("adjuntos/$docu");
           $url_borrar=route('comprobantes.borrar',$dato->id);
           $txt_msj="'".'¿Seguro que desea ELIMINAR. ?'."'";
           $adjs.='<div style="display:flex;"> <a href="'.$url_adj.'" style="color: #2270D1;" target="_blank"> 
                <i class="fa fa-file-pdf-o"></i> '.$dato->adjunto.'
               </a>
               <a class="btn btn-success btn-sm" href="'.$url_borrar.'" style="margin-left:10px;" onclick="return confirm('.$txt_msj.')"> <i class="fa fa-remove"></i> </a>
               </div>';
        }
        return $adjs;    
    }

}

