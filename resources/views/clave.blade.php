
@inject('viewWebs','App\WebMaster')
@extends('layouts.templete')
@section('title','Cambiar Contraseña')
@section('cabecera')
    <h1> Cambiar Contraseña <small> ... </small> </h1>
@endsection
@section('contenido') 




<div class="row" style="margin-top: -5px;">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align: center;font-size: 12pt;"> <i class="fa fa-user"></i> Cambiar Contraseña</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            
        {!! Form::open(['route'=>['cambiar.nuevaclave'],'method'=>'POST']) !!}
        <input type="hidden" name="Usuario" value="{{ Auth::user()->id }}">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="text-align: center;">
            <img width="70" src="{{ asset('images/webmaster.png') }}">
          </div>
          <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nueva Contraseña: </label>
                        <input type="password" class="form-control" name="Clave" required="" placeholder="Contrseña..." style="border-radius: 5px;">
                    </div>
                    <p style="text-align: center;">
                        <button type="submit" class="btn btn-warning" name="btnAceptar" id="btnaceptar">
                        <i class="fa fa-check"></i> Aceptar</button>
                        <a href="{{ route('home') }}" class="btn bg-navy" data-dismiss="modal">
                        <i class="fa fa-remove"></i> Cancelar</a>
                    </p>
                 </div>
             </div>


          </div>
        </div>
        </form>

          </div>
        </div>
      </div>
    </div>
</div>
</div>



<script type="text/javascript">
$(document).ready(function(){

}); 
</script>


@endsection
