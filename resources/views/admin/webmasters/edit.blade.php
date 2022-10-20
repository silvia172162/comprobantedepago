@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.templete')
@section('title','Editar Usuarios')
@section('cabecera')
    <h1> Usuarios <small> Editar </small> </h1>
@endsection
@section('contenido') 
<hr>
<div class="row">
  <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

{!! Form::open(['route'=>['usuarios.update',$dato->id],'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
        <!--<input type="hidden" name="Usuario" value="{{ Auth::user()->id }}"> -->

        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="text-align: center;">

              @if($dato->foto=='usuario.png')
              <img src="{{ asset('images/usuario.png') }}" width="70">
              @else
              <?php  $fp=$dato->foto; ?>
              <img src='{{ asset("images/users/$fp") }}' width="70">
              @endif

          </div>
          <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rol:</label>
                        <select class="form-control" name="Rol" id="cmb_rol" required style="border-radius: 5px;">
                            <option value="">Seleccione...</option>
                            {!! $funciones->cmb_roles() !!}
                        </select>
                    </div>
                 </div> 
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">DNI</label>
                        <input type="text" name="Dni" class="form-control" placeholder="DNI"  maxlength="8" minlength="8" value="{{ $dato->Dni }}" required id="docu">
                    </div>
                 </div>                 
             </div>
             <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombres y Apellidos</label>
                        <input type="text" name="Nombres" class="form-control" placeholder="Nombres y Apellidos" required="" value="{{ $dato->Nombres }}">
                    </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico</label>
                        <input type="email" name="Email" class="form-control" placeholder="Correo Electrónico" required="" value="{{ $dato->email }}" id="correo">
                    </div>
                 </div>
             </div>
             
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Estado</label>
                        {!! Form::select('Estado',['0'=>'DESACTIVADO','1'=>'ACTIVO'],$dato->Estado,
                        ['class'=>'form-control','placeholder'=>'Seleccione...','required','style'=>'border-radius:5px;']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Clave</label>
                       <input type="text" name="password" class="form-control" placeholder="Clave" >
                       <span style="font-size: 10pt;color: #065AAF;">(Opcional)</span>
                    </div>
                </div> 
            </div>


                <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto<span style="font-size: 10pt;color: #065AAF;">(Opcional)</span> : </label>
                            <input type="file" name="Foto" class="form-control" accept=".png, .jpg, .jpeg" style="border-radius: 5px;">
                        </div>
                     </div>
                 </div>

            <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
                  <a href="{{ route('usuarios.index') }}" class="btn btn-default" style="margin-right: 10px;">
                  <i class="fa fa-remove"></i> Cancelar</a>

<button type="submit" class="btn btn-primary" name="btnAceptar" id="btnaceptar" >
                   <i class="fa fa-check"></i> Aceptar</button>

                 </div>
            </div>
          </div>
        </div>
    </form>

  </div>
</div>





<script >

$('#cmb_rol').val("{{ $dato->Rol }}");



$('#docu').change(function(){ validar(); });
$('#docu').keyup(function(){ validar(); });

$('#correo').change(function(){ validar(); });
$('#correo').keyup(function(){ validar(); });
//

function validar(){
    var correo=$('#correo').val();
    var numero=$('#docu').val();
    if (correo!='' && numero!='' ) {
        $.ajax({
        url:"{{ route('validar_user') }}",
        data:{correo:correo,numero:numero},
        method:'GET',
        dataType:'json',
        success:function(data){
            if (data.docu=='Si' && numero!="{{ $dato->Dni }}") {
                $('#docu').css('border-color','#F12E2E');
                $('#btnaceptar').prop('disabled',true);
            }else{
                $('#docu').css('border-color','#26C70C');
                $('#btnaceptar').prop('disabled',false);
            }

            if (data.correo=='Si' && correo!="{{ $dato->email }}") {
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



$(document).ready(function(){

}); 
</script>


@endsection
