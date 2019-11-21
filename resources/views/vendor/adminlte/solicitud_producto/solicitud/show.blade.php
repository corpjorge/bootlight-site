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



 <a class="btn btn-app" href="{{ url('solicitudes/solicitados')}}">

        <i class="fa fa-arrow-left"></i> Atras

      </a>



<section class="content container-fluid">



     







{!! Form::open(['url' => 'solicitudes/solicitados-excelEstado/'.$id, 'method' => 'post']) !!}

 <div class="col-xs-2" style="position: relative; left: 84%;">

    <div class="input-group input-group-sm">

      {{--<input type="date" class="form-control" name="fecha">--}}

          <span class="input-group-btn">

            <button type="submit" class="btn btn-info btn-flat"><i aria-hidden="true" class="fa fa-download"></i></button>

          </span>

    </div>

 </div>

 {!! Form::close() !!} <br><br>





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

              <h3 class="box-title">Actividades </h3> <a href=""><i class="fa fa-refresh"></i></a>





            </div>

            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">

              <table class="table table-hover" >

                <tbody><tr>

                  <th>#</th>

                  <th>Cliente</th>
                  
                  <th>Fecha aprobación</th>

                  <th>Producto</th>

                  <th>Codigo</th>

                  <th>cedula</th>

                  <th>celular</th>

                  <th>monto</th>

                  <th>cuotas</th>                  

                  <th>Estado</th>
                  
                  <th>Obs</th>

                  <th>Comprobante</th>

                  <th>Adju</th>

                  <th></th>

                </tr>

                @foreach ($rows as $key)

                <tr id="tabla_act_client">

                  <td>{{$key->id}}</td>

                  <td>{{$key->user->name}}</td>
                  
                  <td>{{$key->aprobado}}</td>

                  <td>{{$key->producto->name}}</td>                  

                  <td>{{$key->cod_asociado}}</td>                  

                  <td>{{$key->cedula}}</td>                  

                  <td>{{$key->celular}}</td>                  

                  <td>{{$key->monto}}</td>                  

                  <td>{{$key->cuotas}}</td>  

                  <td>{{$key->observacion}}</td>                                      
                  <td>{{$key->obs}}</td>                                      

                  <td>

                    @if($key->estado->id == 5)

                     <a href="{{url('solicitud/comprobante-adm/'.$key->id)}}">Ver</a>

                    @else

                    - 

                    @endif

                  </td>                                      

                  <td>

                    <a href="{{url('solicitudes/solicitados-descarga/'.$key->img)}}" ><i class="fa fa-download" aria-hidden="true"></i></a>

                                                       

                  <td>

                    @if($key->estados_id == 3) 

                     <a href="{{ url('solicitudes/solicitados/ver/'.$key->id) }}"> Ver</a> 

                    @endif                  

                  </td>                  

                               

                </tr>

                @endforeach



              </tbody></table>

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->

        </div>

      </div>

      {{ $rows->links() }} 



    </section>







@endsection

