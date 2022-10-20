@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.templete')
@section('title','Comprobantes')
@section('cabecera')
    <h1> Comprobantes <small> Lista </small> </h1>
@endsection
@section('contenido') 
<div class=""> 
   
 
 <?php $op_crud=$op_user!='' ? $op_user : 0;  ?>
  <div class="modal fade" id="confirmar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-file-pdf-o"></i> Registrar Comprobante</h4>
        </div> 
        <form class="form-horizontal" action="{{ route('comprobantes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

        <input type="hidden" id="id_proy" name="id_proy">

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">N° Comprobante:</label>
                            <input type="text" id="num_comprob" class="form-control" name="numero" placeholder="N° Comprobante" readonly>
                        </div>
                     </div> 
                </div>
   

                <div class="row">
                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                     <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Documento <span style="font-size: 10pt;color: #065AAF;">(PDF)</span>:</label>
                           <input type="file" name="adjunto" accept=".pdf" class="form-control" style="border-radius: 5px;" required>

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
           <i class="fa fa-check"></i> Registrar</button>
        </div>
    </form>

      </div>
    </div>
  </div>

<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
       
        <a href="{{route('comprobantes.index')}}" class="btn btn-link"> 
            <i class="fa fa-refresh"></i> Actualizar..
        </a>


    </div>
    {!! Form::open(['route'=>'comprobantes.index','method'=>'GET']) !!}
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-right: -10px;">   
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
      <th>Num. Comprobante</th>
      <th>Fecha</th>
      <th>Reg. SIAF</th>
      <th>Concepto</th>
      <th>Monto</th>
      <th>Documentos</th>
  </thead>
  <tbody>
      @foreach($listadatos as $dato)
      <tr>
          <td style="text-align: center;color: #2270D1;">
            <i class="fa fa-folder-open"></i>
          </td>
          <td>{{ $dato->numero }}</td>
          <td>{{ $dato->fecha }}  </td>
          <td>{{ $dato->reg_siaf }}</td>
          <td>{{ $dato->concepto }}</td>
          <td>{{ $dato->monto }}</td>   
          <td>
            
            @if($funciones->adjuntos_proy($dato->id)=='')
            <button type="button" class="btn btn-link" style="margin-right: 10px;border-radius: 5px" data-toggle="modal" data-target="#confirmar" onclick="adjuntar({{ $dato->id }},'{{ $dato->numero }}')">
            <i class="fa fa-plus"></i>  Adjuntar
            </button>
            @else
                {!! $funciones->adjuntos_proy($dato->id) !!}
            @endif
            
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

    function adjuntar(id_proy,num_comprob){
        $('#id_proy').val(id_proy);
        $('#num_comprob').val(num_comprob);
    }

    if ({{ $op_crud }}==1) { toastr.success("Datos Registrados!"); }
    if ({{ $op_crud }}==2) { toastr.warning("Se ha Actualizado!"); }
    if ({{ $op_crud }}==3) { toastr.error("Se ha Eliminado!"); }

    $(document).ready(function() {


    });
</script>
@endsection
