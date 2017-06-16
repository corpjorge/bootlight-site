@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="col-md-6">
		           <div class="box box-solid">
		             <div class="box-header with-border">
		               <h3 class="box-title">Fonsodi</h3>
		             </div>
		             <!-- /.box-header -->
		             <div class="box-body">
		               <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                 <ol class="carousel-indicators">
		                   <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                   <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                   <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                 </ol>
		                 <div class="carousel-inner">
		                   <div class="item active">
		                     <img src="http://fonsodi.com/images/creditos/img_creditos.jpg" alt="First slide" style="width: 900; ">

		                     <div class="carousel-caption">
		                       Fonsodi
		                     </div>
		                   </div>
		                   <div class="item">
		                     <img src="http://fonsodi.com/images/somos/img_fonsodi1.jpg" alt="Second slide">

		                     <div class="carousel-caption">
		                       Fonsodi
		                     </div>
		                   </div>
		                   <div class="item">
		                     <img src="http://fonsodi.com/images/creditos/img_creditos.jpg" alt="Third slide" >

		                     <div class="carousel-caption">
		                       Fonsodi
		                     </div>
		                   </div>
		                 </div>
		                 <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                   <span class="fa fa-angle-left"></span>
		                 </a>
		                 <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                   <span class="fa fa-angle-right"></span>
		                 </a>
		               </div>
		             </div>
		             <!-- /.box-body -->
		           </div>
		           <!-- /.box -->
		         </div>


		@foreach ($menu_users as $menu_user)
			  @if ($menu_user->estado->id == '1' )
					@if($menu_user->area_id == 1)
						<div class="col-lg-3 col-xs-6">
							<div class="small-box {{$menu_user->estilo}}">
								<div class="inner">
									<h4>Perfil</h4>
									<p>Mi perfil</p>
								</div>
								<div class="icon">
									<i class="fa {{$menu_user->icono}}"></i>
								</div>
								<a href="{{ url('perfil') }}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					@else
						<div class="col-lg-3 col-xs-6">
						  <div class="small-box {{$menu_user->estilo}}">
						    <div class="inner">
						      <h4>{{$menu_user->area->name}}</h4>
						      <p>{{$menu_user->area->descripcion}}</p>
						    </div>
						    <div class="icon">
						      <i class="fa {{$menu_user->icono}}"></i>
						    </div>
						    <a href="{{ url($menu_user->ruta) }}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
						  </div>
						</div>
					@endif
				@endif
		@endforeach

		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-navy">
				<div class="inner">
					<h4>ESTADO DE CUENTA</h4>
					<p>Módulo de atención</p>
				</div>
				<div class="icon">
					<i class="fa fa-user"></i>
				</div>
				<a href="{{ url('atencion') }}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>






			</div>
	</div>


@endsection
