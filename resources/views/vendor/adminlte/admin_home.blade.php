@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">

@if(Auth::guard('admin_user')->user()->role_id == '1' OR Auth::guard('admin_user')->user()->role_id == '2')
			@foreach ($menu_admins as $menu_admin)
					@if ($menu_admin->estado->id == '1' )
						<div class="col-lg-3 col-xs-6">
							<div class="small-box {{$menu_admin->estilo}}">
								<div class="inner">
									<h4>{{$menu_admin->area_admin->name}}</h4>
									<p>{{$menu_admin->area_admin->descripcion}}</p>
								</div>
								<div class="icon">
									<i class="fa {{$menu_admin->icono}}"></i>
								</div>
								<a href="{{ url($menu_admin->ruta) }}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					@endif
		@endforeach
@else

@foreach ($adminpermisos as $adminpermiso)
	@foreach ($menu_admins as $menu_admin)
			@if ($menu_admin->estado->id == '1' )
				@if ($adminpermiso->permiso_area_admin->id == $menu_admin->id )
				@if(Auth::guard('admin_user')->user()->id == $adminpermiso->admin_user_id)
					<div class="col-lg-3 col-xs-6">
						<div class="small-box {{$menu_admin->estilo}}">
							<div class="inner">
								<h4>{{$menu_admin->area_admin->name}}</h4>
								<p>{{$menu_admin->area_admin->descripcion}}</p>
							</div>
							<div class="icon">
								<i class="fa {{$menu_admin->icono}}"></i>
							</div>
							<a href="{{ url($menu_admin->ruta) }}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
				@endif	
				@endif
			@endif
	@endforeach
@endforeach


@endif






		</div>
	</div>
@endsection
