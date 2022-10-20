@inject('funciones','App\Http\Controllers\FuncionesController')
@extends('layouts.templete')
@section('title','Proyectos')
@section('cabecera')
    <h1> Proyectos <small> Lista </small> </h1>
@endsection
@section('contenido') 
<div class=""> 
   
 <?php $op_crud=$op_user!='' ? $op_user : 0;  ?>

  <div class="modal fade" id="confirmar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-folder"></i> Registrar Proyecto</h4>
        </div> 
        <form class="form-horizontal" action="{{ route('proyectos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_tbl" id="id_tbl">
        <input type="hidden" id="v_num">
        <div class="modal-body">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">N° Comprobante:</label>
                            <input type="text" class="form-control" name="numero" placeholder="N° Comprobante" required id="v1">
                        </div>
                     </div> 
                     <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" required id="v2">
                        </div>
                     </div>
                     <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Reg. SIAF:</label>
                            <input type="text" class="form-control" name="siaf" required placeholder="Reg. SIAF" id="v3">
                        </div>
                     </div>
                </div>
                <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dependencia:</label>
                            <input type="text" class="form-control" name="dependencia" placeholder="Dependencia" required id="v4">
                        </div>
                     </div> 
                     <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                     <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Concepto:</label>
                            <textarea  class="form-control" name="concepto" required placeholder="Concepto" style="border-radius: 5px;" id="v5"></textarea>
                        </div>
                     </div>
                </div>

                <div class="row">
                     <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Observaciones <span style="font-size: 10pt;color: #065AAF;">(Opcional)</span> :</label>
                            <textarea  class="form-control" name="observacion" placeholder="Observaciones" style="border-radius: 5px;" rows="1" id="v6"></textarea>
                        </div>
                     </div> 
                     <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Monto:</label>
                            <input type="number" name="monto" class="form-control" required step="1" placeholder="Monto" id="v7">
                        </div>
                     </div>
                </div>

                <div class="row">
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Proyecto <span style="font-size: 10pt;color: #065AAF;">(Ejem: ENAHO, ... )</span> :</label>
                            <input type="text" class="form-control" name="proyecto" placeholder="Ejem: ENAHO, ..." required id="v8">
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
        <button type="button" class="btn btn-primary" style="margin-right: 10px;border-radius: 5px" data-toggle="modal" data-target="#confirmar" onclick="nuevo()">
            <i class="fa fa-plus"></i> Nuevo proyecto
        </button>
        <a href="{{route('proyectos.index')}}" class="btn btn-link"> 
            <i class="fa fa-refresh"></i> Actualizar..
        </a>

        <a href="{{url('/proyectos')}}?orden=asc" class="btn btn-link"> 
            <i class="fa fa-arrow-circle-up"></i> Menor a mayor
        </a> 

        <a href="{{url('/proyectos')}}?orden=desc" class="btn btn-link"> 
            <i class="fa fa-arrow-circle-down"></i> Mayor a menor
        </a> 

    </div>
    {!! Form::open(['route'=>'proyectos.index','method'=>'GET']) !!}
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-right: -10px;">   
        <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <input type="text" name="buscar" class="form-control" placeholder="Buscar proyecto..." aria-describedby="search" value="{{ $valbuscar }}" style="border-radius: 5px;">
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
      <th>Comprobante</th>
      <th>Fecha</th>
      <th>Reg. SIAF</th>
      <th>Dependencia</th>
      <th>Concepto</th>
      <th>Proyecto</th>
      <th>Monto</th>
      <th>Opciones</th>
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
          <td>{{ $dato->dependencia }}</td>
          <td>{{ $dato->concepto }}</td>
          <td>{{ $dato->proyecto }}</td>
          <td>{{ $dato->monto }}</td>   
          <td>
              <button type="button" class="btn btn-info btn-sm" onclick="editar({{ $dato->id }},'{{ $dato->numero }}','{{ $dato->fecha }}','{{ $dato->reg_siaf }}','{{ $dato->dependencia }}','{{ $dato->concepto }}','{{ $dato->observacion }}','{{ $dato->monto }}','{{ $dato->proyecto }}')" data-toggle="modal" data-target="#confirmar">
                  <i class="fa fa-wrench"></i> 
              </button>

              <form style="display: inline;" method="POST" action="{{route('proyectos.destroy',$dato->id)}}">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button type="submit" onclick="return confirm('¿Seguro que desea ELIMINAR. ?')" class="btn btn-success btn-sm">
                  <i class="fa fa-remove"></i> 
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



<script type="text/javascript">

if ({{ $op_crud }}==1) { toastr.success("Datos Registrados!"); }
if ({{ $op_crud }}==2) { toastr.warning("Se ha Actualizado!"); }
if ({{ $op_crud }}==3) { toastr.error("Se ha Eliminado!"); }

function nuevo() {
    $('#id_tbl').val('');
    $('#v1').val('');
    $('#v2').val('');
    $('#v3').val('');
    $('#v4').val('');
    $('#v5').val('');
    $('#v6').val('');
    $('#v7').val('');
    $('#v8').val('');
    $('#v_num').val('');
    $('#v1').css('border-color','#C3C6C3');
    $('#btnaceptar').prop('disabled',false);

}

function editar(id,v1,v2,v3,v4,v5,v6,v7,v8){
    $('#id_tbl').val(id);
    $('#v_num').val(v1);
    $('#v1').val(v1);
    $('#v2').val(v2);
    $('#v3').val(v3);
    $('#v4').val(v4);
    $('#v5').val(v5);
    $('#v6').val(v6);
    $('#v7').val(v7);
    $('#v8').val(v8);
    $('#v1').css('border-color','#C3C6C3');
    $('#btnaceptar').prop('disabled',false);
}




$('#v1').change(function(){ validar(); });
$('#v1').keyup(function(){ validar(); });


function validar(){
    var numero=$('#v1').val();
    if (numero!='') {
        $.ajax({
        url:"{{ route('validar_proy') }}",
        data:{numero:numero},
        method:'GET',
        dataType:'json',
        success:function(data){
            if (data.docu=='Si' && $('#v_num').val()!=numero) {
                $('#v1').css('border-color','#F12E2E');
                $('#btnaceptar').prop('disabled',true);
            }else{
                $('#v1').css('border-color','#26C70C');
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
