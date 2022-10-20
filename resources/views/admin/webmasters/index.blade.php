@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.templete')
@section('title','Usuarios')
@section('cabecera')
    <h1> Usuarios <small> Lista </small> </h1>
@endsection
@section('contenido') 
<div class=""> 
   
<?php $op_crud=$op_user!='' ? $op_user : 0;  ?>

  <div class="modal fade" id="confirmar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-user-plus"></i> Registrar Usuario</h4>
        </div> 
        <form class="form-horizontal" action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
        <!--<input type="hidden" name="Usuario" value="{{ Auth::user()->id }}"> -->
        <div class="modal-body">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="text-align: center;">
            <img width="70" src="{{ asset('images/webmaster.png') }}">
          </div>
          <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rol:</label>
                        <select class="form-control" name="Rol" required style="border-radius:5px;">
                            <option value="">Seleccione...</option>
                            {!! $funciones->cmb_roles() !!}
                        </select>
                    </div>
                 </div>                
             </div>            
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">DNI <span style="font-size: 10pt;color: #065AAF;">(Clave de acceso)</span></label>
                        <input type="text" name="Dni" class="form-control" placeholder="DNI" required="" maxlength="8" minlength="8" id="docu">
                    </div>
                 </div>                
             </div>
             <div class="row">
                 <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombres y Apellidos</label>
                        <input type="text" name="Nombres" class="form-control" placeholder="Nombres y Apellidos" required="">
                    </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico</label>
                        <input type="email" name="Email" class="form-control" placeholder="Correo Electrónico" required="" id="correo">
                    </div>
                 </div>
             </div>

             <div class="row">
                 <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Foto <span style="font-size: 10pt;color: #065AAF;">(Subir en png)</span></label>
                        <input type="file" name="Foto" class="form-control" required accept=".png, .jpg, .jpeg" style="border-radius: 5px;">
                    </div>
                 </div>
             </div>


          </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
             <i class="fa fa-remove"></i> Cancelar
            </button>
           <button type="submit" class="btn btn-primary" name="btnAceptar" id="btnaceptar" disabled>
           <i class="fa fa-check"></i> Aceptar</button>
        </div>
    </form>

      </div>
    </div>
  </div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <button type="button" class="btn btn-primary" style="margin-right: 10px;border-radius: 5px" data-toggle="modal" data-target="#confirmar" >
            <i class="fa fa-plus"></i> Nuevo usuario
        </button>
        <a href="{{route('usuarios.index')}}" class="btn btn-link"> 
            <i class="fa fa-refresh"></i> Actualizar..
        </a>      
    </div>
    {!! Form::open(['route'=>'usuarios.index','method'=>'GET']) !!}
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-right: -10px;">   
        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <input type="text" name="buscar" class="form-control" placeholder="Buscar usuario..." aria-describedby="search" value="{{ $valbuscar }}" style="border-radius: 5px;">
        </div>     
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <button class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
            <i class="fa fa-search"></i> Buscar
        </button>
    </div>
    {!! Form::close() !!} 
</div>

<hr style="margin: 5px;">

    <div class="row justify-content-center">
        <div class="col-lg-12">



                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover card-table table-vcenter text-nowrap mb-0">
     <thead style="background-color: #D6E8F9;color: #003366;">
      <th style="text-align: center;">#</th>
      <th>Rol</th>
      <th>Nombres y Apellidos</th>
      <th>DNI</th>
      <th>Email</th>
      <th>Estado</th>
      <th>Opciones</th>
  </thead>
  <tbody>
      @foreach($listadatos as $dato)
      <tr>
          <td style="text-align: center;color: #2270D1;">
            @if($dato->foto=='usuario.png')
              <img src="{{ asset('images/usuario.png') }}" width="30">
              @else
              <?php  $fp=$dato->foto; ?>
              <img src='{{ asset("images/users/$fp") }}' width="30">
              @endif
          </td>
          <td>{{ $funciones->nom_rol($dato->Rol) }}</td>
          <td>{{ $dato->Nombres}}  </td>
          <td>{{ $dato->Dni }}</td>
          <td>{{ $dato->email }}</td>
          <td>
            @if($dato->Estado==0)
              <span style="color: #fff;background-color: #737572;border-radius: 5px;padding-left: 5px;padding-right: 5px;"> Desactivado</span> 
            @endif
            @if($dato->Estado==1)
              <span style="color: #fff;background-color: #2E9C07;border-radius: 5px;padding-left: 5px;padding-right: 5px;"> Activo</span> 
            @endif
          </td>       
          <td>
              <a href="{{route('usuarios.edit',$dato->id)}}" class="btn btn-info btn-sm">
                  <i class="fa fa-wrench"></i> Editar
              </a>
              <form style="display: inline;" method="POST" action="{{route('usuarios.destroy',$dato->id)}}">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button type="submit" onclick="return confirm('¿Seguro que desea ELIMINAR. ?')" class="btn btn-success btn-sm">
                  <i class="fa fa-remove"></i> Eliminar
                </button>
              </form>
          </td>
      </tr>
      @endforeach
  </tbody>
                                </table>
                            </div>
                            <hr class="m-1">
                            <div class="text-center">
                                {!! $listadatos->render()!!}
                            </div>
                        </div>
                    </div>



        </div>
    </div>
</div>



<script>


function nuevo() {
    $('#id_tbl').val('');
    $('#descripcion').val('');
}


if ({{ $op_crud }}==1) { toastr.success("Usuario Registrado!"); }
if ({{ $op_crud }}==2) { toastr.warning("Usuario Actualizado!"); }
if ({{ $op_crud }}==3) { toastr.error("Usuario Eliminado!"); }



$('#docu').change(function(){ validar(); });
$('#docu').keyup(function(){ validar(); });

$('#correo').change(function(){ validar(); });
$('#correo').keyup(function(){ validar(); });
//

function validar(){
    var correo=$('#correo').val();
    var numero=$('#docu').val();
    if (correo!='' && numero!='') {
        $.ajax({
        url:"{{ route('validar_user') }}",
        data:{correo:correo,numero:numero},
        method:'GET',
        dataType:'json',
        success:function(data){
            if (data.docu=='Si') {
                $('#docu').css('border-color','#F12E2E');
                $('#btnaceptar').prop('disabled',true);
            }else{
                $('#docu').css('border-color','#26C70C');
                $('#btnaceptar').prop('disabled',false);
            }

            if (data.correo=='Si') {
                $('#correo').css('border-color','#F12E2E');
                $('#btnaceptar').prop('disabled',true);
            }else{
                $('#correo').css('border-color','#26C70C');
                $('#btnaceptar').prop('disabled',false);
            }
        }
        });
    }
}


$(document).ready(function() {


});

</script>
@endsection
