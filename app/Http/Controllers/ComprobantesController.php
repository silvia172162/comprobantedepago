<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Proyectos;
use App\Models\Comprobantes;

class ComprobantesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $op_user=$request->op!='' ? $request->op : '';
        if ($request->orden!='') {
            $dtDatos=Proyectos::Buscar($request->buscar)->orderBy('monto',$request->orden)->paginate(10);
        }else{
            $dtDatos=Proyectos::Buscar($request->buscar)->paginate(10);
        }
        
        return view('comprobantes.index',['listadatos'=>$dtDatos,'valbuscar'=>$request->buscar,'op_user'=>$op_user]);
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

        $txtadjunto='';
        if($request->file('adjunto'))
        {
            $archivo=$request->file('adjunto');
            $txtadjunto='doc_'.Str::random(10).'.pdf';
            $path=public_path().'/adjuntos';
            $archivo->move($path,$txtadjunto);
        }

        $dtDato=new Comprobantes();
        $dtDato->id_proyecto=$request->id_proy;
        $dtDato->numero=$request->numero;
        $dtDato->adjunto=$txtadjunto;
        $dtDato->save();
        return redirect()->route('comprobantes.index','op=1');

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
        $dt=Comprobantes::find($id);
        $doc=public_path().'/adjuntos/'.$dt->adjunto;
        if (file_exists($doc)) { unlink($doc); }
        $dt->delete();
        return redirect()->route('comprobantes.index','op=3');
    }
}
