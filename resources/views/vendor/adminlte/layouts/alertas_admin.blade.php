@foreach ($alert_admins as $alert_admin)
  @if($alert_admin->estado_id == '1')
    @if($alert_admin->fecha_finalizacion < $carbon->format('Y-m-d'))
          <div class="box-body">
              <div class="alert {{$alert_admin->estilo}} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa {{$alert_admin->icono}}"></i> {{$alert_admin->titulo}}</h4>
                {{$alert_admin->mensaje}}
          </div>
    @endif
  @endif
@endforeach
