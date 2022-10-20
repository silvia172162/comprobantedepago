<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Date;
use App\WebMaster;
use App\Models\Comprobantes;
use App\Models\Proyectos;


class AjaxController extends Controller
{
    
    public function __construct()
    {
       $this->middleware(['auth']);
    }

    public function clave()
    {
        return view('clave');
    }

    public function CambiarClave(Request $request)
    {
        $dtDato=WebMaster::find($request->Usuario);
        $dtDato->password=bcrypt($request->Clave);
        $dtDato->save();
        return redirect()->route('home');
    }


    public function validar_user(Request $request)
    {
        if ($request->ajax()) {

            $numero=$request->get('numero');
            $correo=$request->get('correo');

            $aux_docu='No';
            $aux_email='No';
            $dtBuscar=WebMaster::where('Dni',$numero)->count('id');
            if ($dtBuscar>0) { $aux_docu='Si'; }

            $dt_email=WebMaster::where('email',$correo)->count('id');
            if ($dt_email>0) { $aux_email='Si'; }

            $data=array('docu' =>$aux_docu,'correo'=>$aux_email);
            echo json_encode($data);
        }
    }



    public function validar_proy(Request $request)
    {
        if ($request->ajax()) {
            $numero=$request->get('numero');
            $aux_docu='No';
            $dtBuscar=Proyectos::where('numero',$numero)->count('id');
            if ($dtBuscar>0) { $aux_docu='Si'; }
            $data=array('docu' =>$aux_docu);
            echo json_encode($data);
        }
    }

}

