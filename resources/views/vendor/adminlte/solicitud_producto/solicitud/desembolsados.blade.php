@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
<section class="content-header">
    <h1>Productos
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</li>
				<li><a href="{{ url('/Productos')}}">Productos</a></li>
    </ol>
</section>
<br>


<section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('solicitudes/solicitados')}}">
        <i class="fa fa-arrow-left"></i> Atras
      </a>

      <a class="btn btn-app" href="{{ url('solicitudes/solicitados-excel')}}">
        <i class="fa fa-download"></i> Descargar
      </a>

      @if(session()->has('message'))
                     <div class="alert alert-success alert-dismissible">
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                               <h4><i class="icon fa fa-check"></i> Correcto!</h4>
                               {{session()->get('message')}}
                             </div>
                    @endif
 
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Actividades</h3> <a href=""><i class="fa fa-refresh"></i></a>


            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            	{!! Form::open(['url' => 'solicitudes/solicitados/aprobar', 'method' => 'POST']) !!}
              <table class="table table-hover" >
                <tbody><tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Producto</th>
                  <th>Codigo</th>
                  <th>cedula</th>
                  <th>celular</th>
                  <th>monto</th>
                  <th>cuotas</th>                  
                  <th>Obs</th>
                  <th>Adju</th>
                  <th><button type="submit" class="btn btn-primary">Aprobar</button></th>
                </tr>
                @foreach ($rows as $key)
                <tr id="tabla_act_client">
                  <td>{{$key->id}}</td>
                  <td>{{$key->user->name}}</td>
                  <td>{{$key->producto->name}}</td>                  
                  <td>{{$key->cod_asociado}}</td>                  
                  <td>{{$key->cedula}}</td>                  
                  <td>{{$key->celular}}</td>                  
                  <td>{{$key->monto}}</td>                  
                  <td>{{$key->cuotas}}</td>  
                  <td>{{$key->observacion}}</td>                                      
                  <td>{{$key->img}}</td>                                      
                  <td>         
	                    <label>
	                      <input type="checkbox" name="solicitud[]" value="{{$key->id}}">
	                      Seleccionar
	                    </label>  
                  </td>                  
                               
                </tr>
                @endforeach

              </tbody></table>{!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
     

    </section>



@endsection
