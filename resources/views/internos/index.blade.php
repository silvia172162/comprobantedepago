@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.templete')
@section('title','Comprobantes Internos')
@section('cabecera')
    <h1> Comprobantes Internos <small> Lista </small> </h1>
@endsection
@section('contenido') 
<div class=""> 
   
 <?php $op_crud=$op_user!='' ? $op_user : 0;  ?>



  <div class="modal fade" id="confirmar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-plus"></i> Registrar comprobante inerno</h4>
        </div> 
        <form class="form-horizontal" action="{{ route('c_internos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
<input type="hidden" name="id_tbl" id="id_tbl">
        <div class="modal-body">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="text-align: center;">
            
          </div>
          <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">          
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Concepto <span style="font-size: 10pt;color: #065AAF;"> Ejm: Luz, Agua, Internet, etc</span></label>
                        <input type="text" name="tipo" class="form-control" placeholder="Concepto" required="" id="v1">
                    </div>
                 </div>                
             </div>
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Monto:</label>
                        <input type="number" name="monto" class="form-control" placeholder="Monto" required="" step="1" id="v2">
                    </div>
                 </div>                
             </div>
            <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fecha:</label>
                        <input type="date" name="fecha" class="form-control" placeholder="Fecha" required="" id="v3">
                    </div>
                 </div>                
             </div>
             <div class="row">
                 <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Archivo:</label>
                        <input type="file" name="Adjunto" class="form-control" required accept=".pdf" style="border-radius: 5px;" id="docu">
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
           <button type="submit" class="btn btn-primary" name="btnAceptar" id="btnaceptar">
           <i class="fa fa-check"></i> Aceptar</button>
        </div>
    </form>

      </div>
    </div>
  </div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <button type="button" class="btn btn-primary" style="margin-right: 10px;border-radius: 5px" data-toggle="modal" data-target="#confirmar" onclick="nuevo();">
            <i class="fa fa-plus"></i> Nuevo comprobante
        </button>
        <a href="{{route('c_internos.index')}}" class="btn btn-link"> 
            <i class="fa fa-refresh"></i> Actualizar..
        </a>      
    </div>
    {!! Form::open(['route'=>'c_internos.index','method'=>'GET']) !!}
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-right: -10px;">   
        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <input type="text" name="buscar" class="form-control" placeholder="Buscar comprobante..." aria-describedby="search" value="{{ $valbuscar }}" style="border-radius: 5px;">
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
      <th>Concepto</th>
      <th>Fecha</th>
      <th>Monto</th>
      <th>Comprobante</th>
      <th>Opciones</th>
  </thead>
  <tbody>
      @foreach($listadatos as $dato)
      <tr>
        <td> <i class="fa fa-file"></i> </td>
          <td>{{ $dato->tipo}}  </td>
          <td>{{ $dato->fecha }}</td>
          <td>{{ $dato->monto }}</td>
          <td>
            <?php $fp=$dato->adjunto; ?>
              <a href='{{ asset("internos/$fp") }}' style="color: #2270D1;" target="_blank"> 
                <i class="fa fa-file-pdf-o"></i> {{ $dato->adjunto }}
               </a>
          </td>
          <td>
              <button type="button" class="btn btn-info btn-sm" onclick="editar({{ $dato->id }},'{{ $dato->tipo}}','{{ $dato->monto }}','{{ $dato->fecha }}')" data-toggle="modal" data-target="#confirmar">
                  <i class="fa fa-wrench"></i> Editar
              </button>
              <form style="display: inline;" method="POST" action="{{route('c_internos.destroy',$dato->id)}}">
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
    $('#v1').val('');
    $('#v2').val('');
    $('#v3').val('');
    $('#docu').prop('required',true);
}

function editar(id,v1,v2,v3,v4,v5,v6,v7,v8){
    $('#id_tbl').val(id);
    $('#v1').val(v1);
    $('#v2').val(v2);
    $('#v3').val(v3);
    $('#docu').prop('required',false);
}

if ({{ $op_crud }}==1) { toastr.success("Datos Registrados!"); }
if ({{ $op_crud }}==2) { toastr.warning("Se ha Actualizado!"); }
if ({{ $op_crud }}==3) { toastr.error("Se ha Eliminado!"); }

$(document).ready(function() {


});

</script>
@endsection
