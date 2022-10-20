@extends('layouts.templete')
@section('title','Inicio')
@section('cabecera')
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>-->
@endsection
@section('contenido')

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> <i class="fa fa-user"></i> Bienvenido al Sistema </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
        <br>

        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                
                <div class="row">
                    @if(Auth::user()->Rol==1)
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <a href="{{ route('usuarios.index') }}">
                            <div class="panel panel-default" style="border-style: dashed;border-width: 1px;border-color: #0193DE;">
                                <div class="panel-body" style="text-align: center;">
                                    <img src="{{ asset('images/tutores.png') }}" alt="Vender" width="118">
                                    <p style="margin-top: 10px;font-size: 14pt;">
                                        Usuarios
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <a href="{{ route('proyectos.index') }}">
                            <div class="panel panel-default" style="border-style: dashed;border-width: 1px;border-color: #0193DE;">
                                <div class="panel-body" style="text-align: center;">
                                    <img src="{{ asset('images/reporte.png') }}" alt="Vender" width="120">
                                    <p style="margin-top: 10px;font-size: 14pt;">
                                       Proyectos
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div> 
                    @endif  



                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <a href="{{ route('comprobantes.index') }}">
                            <div class="panel panel-default" style="border-style: dashed;border-width: 1px;border-color: #0193DE;">
                                <div class="panel-body" style="text-align: center;">
                                    <img src="{{ asset('images/comprobantes.png') }}" alt="Vender" width="120">
                                    <p style="margin-top: 10px;font-size: 14pt;">
                                       Comprobantes
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div> 

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <a href="{{ route('c_internos.index') }}">
                            <div class="panel panel-default" style="border-style: dashed;border-width: 1px;border-color: #0495DF;">
                                <div class="panel-body" style="text-align: center;">
                                    <img src="{{ asset('images/recibos.png') }}" alt="Vender" width="120">
                                    <p style="margin-top: 10px;font-size: 14pt;">
                                       Comprobantes Internos
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
                 
            </div>
        </div>
        <br><br>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
$(document).ready(function(){


});
</script>


@endsection


