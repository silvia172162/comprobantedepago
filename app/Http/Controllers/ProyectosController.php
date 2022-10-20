<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyectos;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $op_user=$request->op!='' ? $request->op : '';
        if ($request->orden!='') {
            $dtDatos=Proyectos::Buscar($request->buscar)->orderBy('monto',$request->orden)->paginate(10);
        }else{
            $dtDatos=Proyectos::Buscar($request->buscar)->paginate(10);
        }
        
        return view('admin.proyectos.index',['listadatos'=>$dtDatos,'valbuscar'=>$request->buscar,'op_user'=>$op_user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $txt_observ='';
        if($request->observacion!='') { $txt_observ=$request->observacion; }
        if ($request->id_tbl=='') {
            $dtDato=new Proyectos();
        }else{
            $dtDato=Proyectos::find($request->id_tbl);
        }
        
        $dtDato->numero=$request->numero;
        $dtDato->fecha=$request->fecha;
        $dtDato->reg_siaf=$request->siaf;
        $dtDato->dependencia=$request->dependencia;
        $dtDato->concepto=$request->concepto;
        $dtDato->observacion=$txt_observ;
        $dtDato->proyecto=$request->proyecto;
        $dtDato->monto=$request->monto;
        $dtDato->save();

        if ($request->id_tbl=='') {
        return redirect()->route('proyectos.index','op=1');
        }else{
            return redirect()->route('proyectos.index','op=2');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dtDato=Proyectos::find($id);
        $dtDato->delete();
        return redirect()->route('proyectos.index','op=3');
    }
}
