<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\WebMaster;
use App\Roles;
use DB;

class WebMastersController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth','roles:1']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $op_user=$request->op!='' ? $request->op : '';
        $dtDatos=WebMaster::Buscar($request->buscar)->orderBy('Nombres','ASC')->paginate(10);
        return view('admin.webmasters.index',['listadatos'=>$dtDatos,'valbuscar'=>$request->buscar,'op_user'=>$op_user]);
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
        if($request->file('Foto'))
        {
            $archivo=$request->file('Foto');
            $txtfoto='user_'.Str::random(10).'.png';
            $path=public_path().'/images/users';
            $archivo->move($path,$txtfoto);
        }


        $dtDato=new WebMaster();
        $dtDato->Rol=$request->Rol;
        $dtDato->Dni=$request->Dni;
        $dtDato->Nombres=$request->Nombres;
        $dtDato->email=$request->Email;
        $dtDato->email_verified_at=null;
        $dtDato->remember_token=null;
        $dtDato->password=bcrypt($request->Dni);
        $dtDato->Estado=1;
        $dtDato->foto=$txtfoto;
        $dtDato->session_id='';
        $dtDato->save();
        return redirect()->route('usuarios.index','op=1');
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
        $roles = Roles::select(
                DB::raw("CONCAT(Descripcion) AS Descripcion"),'id')
                ->orderBy('Descripcion','ASC')
                ->pluck('Descripcion', 'id');
        $dtDatos=WebMaster::find($id);
        return view('admin.webmasters.edit',['dato'=>$dtDatos,'viewroles'=>$roles]);
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
        $dtDato=WebMaster::find($id);
        $dtDato->Rol=$request->Rol;
        $dtDato->Nombres=$request->Nombres;
        $dtDato->email=$request->Email;
        $dtDato->Estado=$request->Estado;
        if ($request->password!='') { $dtDato->password=bcrypt($request->password); }

        if($request->file('Foto'))
        {
           $foto=public_path().'/images/users/'.$dtDato->foto;
            if (file_exists($foto)) {
               unlink($foto);
            }

            $archivo=$request->file('Foto');
            $txtfoto='user_'.Str::random(10).'.png';
            $path=public_path().'/images/users';
            $archivo->move($path,$txtfoto);
            $dtDato->foto=$txtfoto;
        }

        $dtDato->save();
        return redirect()->route('usuarios.index','op=2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dtDato=WebMaster::find($id);
        //$dtDato->Estado=0;
        //$dtDato->save();
        // borrar foto
       $foto=public_path().'/images/users/'.$dtDato->foto;
        if (file_exists($foto)) {
           unlink($foto);
        }

        $dtDato->delete();
        return redirect()->route('usuarios.index','op=3');
    }




}
