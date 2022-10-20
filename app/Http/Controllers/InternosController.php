<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internos;
use Illuminate\Support\Str;


class InternosController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $op_user=$request->op!='' ? $request->op : '';
        $dtDatos=Internos::Buscar($request->buscar)->orderBy('id','DESC')->paginate(10);
        return view('internos.index',['listadatos'=>$dtDatos,'valbuscar'=>$request->buscar,'op_user'=>$op_user]);
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

        
        $txtfoto='';
        if($request->file('Adjunto'))
        {
            $archivo=$request->file('Adjunto');
            $txtadjunto='com_'.Str::random(10).'.pdf';
            $path=public_path().'/internos';
            $archivo->move($path,$txtadjunto);
        }

        if ($request->id_tbl=='') {
            $dtDato=new Internos();
        }else{
            $dtDato=Internos::find($request->id_tbl);
        }
        $dtDato->tipo=$request->tipo;
        $dtDato->fecha=$request->fecha;
        $dtDato->monto=$request->monto;
        if($request->file('Adjunto')){ $dtDato->adjunto=$txtadjunto; }
        $dtDato->save();
        if ($request->id_tbl=='') {
            return redirect()->route('c_internos.index','op=1');
        }else{
            return redirect()->route('c_internos.index','op=2');
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
        $dtDato=Internos::find($id);
       $foto=public_path().'/internos/'.$dtDato->adjunto;
        if (file_exists($foto)) {
           unlink($foto);
        }

        $dtDato->delete();
        return redirect()->route('c_internos.index','op=3');
    }

    public function prueba()
    {
        return 'datos ';
    }
}
