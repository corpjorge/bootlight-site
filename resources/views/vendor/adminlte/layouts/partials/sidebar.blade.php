<?php
function current_page($url = '/'){
  return request()->path() == $url;
}
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @if (Auth::guard("admin_user")->user())
          @include('adminlte::layouts.partials.adminuserpanel')
        @else(! Auth::guest())
          @include('adminlte::layouts.partials.userpanel')
        @endif


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            @if (Auth::guard("admin_user")->user())
                @if(Auth::guard('admin_user')->user()->role_id == '1' OR Auth::guard('admin_user')->user()->role_id == '2')
                    @foreach ($menu_admins as $menu_admin)
                      @if ($menu_admin->estado->id == '1' )
                      <li class="treeview
                        <?php foreach ($menu_admin_subs as $menu_admin_sub){
                              if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id){
                                if (current_page($menu_admin_sub->ruta)){echo ' active ';}
                              }
                            }
                        ?>">
                        <a href="#"><i class='fa {{$menu_admin->icono}}'></i><span>{{$menu_admin->area_admin->name}}</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                              @foreach ($menu_admin_subs as $menu_admin_sub)
                                @if ($menu_admin_sub->estado->id == '1' )
                                  @if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)
                                    <li class="{{ current_page($menu_admin_sub->ruta) ? 'active': '' }}"><a href="{{ url($menu_admin_sub->ruta) }}">{{$menu_admin_sub->areas_item_admin->name}}</a></li>
                                  @endif
                                @endif
                              @endforeach
                            </ul>
                        </li>
                      @endif
                    @endforeach
                @elseif(Auth::guard('admin_user')->user()->id == 50)
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="#"><i class='fa fa-codepen'></i> <span>Productos</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('solicitudes/solicitados')}}">Solicitudes</a></li>
                            <li><a href="#">Productos</a></li>
                            <li><a href="#">Desembolsos</a></li>
                        </ul>
                    </li>
                </ul>
                @elseif(Auth::guard('admin_user')->user()->id == 22)
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="#"><i class='fa fa-codepen'></i> <span>Productos</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{url('solicitudes/solicitados')}}">Solicitudes</a></li>
                            <li><a href="#">Productos</a></li>
                            <li><a href="{{url('solicitudes/desembolso')}}">Desembolsos</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Este condicional muestra el acceso a la ruta que puede acceder el usuario
                    1. Pasamos el id del usuario que tiene el permiso
                    2. Creamos la ruta de la vista a mostrar para el usuario
                -->
               @elseif(Auth::guard('admin_user')->user()->id == 23)
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="#"><i class='fa fa-codepen'></i> <span>Productos</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('solicitudes/solicitados/7')}}">Servicios confirmados</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                @foreach ($adminpermisos as $adminpermiso)
                    @foreach ($menu_admins as $menu_admin)
                      @if ($menu_admin->estado->id == '1' )
                       @if ($adminpermiso->permiso_area_admin->id == $menu_admin->id )
                       @if(Auth::guard('admin_user')->user()->id == $adminpermiso->admin_user_id)
                       <li class="treeview
                         <?php
                           foreach ($menu_admin_subs as $menu_admin_sub)
                             {
                               if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id){
                                 if (current_page($menu_admin_sub->ruta)){
                                     echo ' active ';
                                   }
                               }
                             }
                         ?>">
                            <a href="#"><i class='fa {{$menu_admin->icono}}'></i><span>{{$menu_admin->area_admin->name}}</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu" >
                              @foreach ($menu_admin_subs as $menu_admin_sub)
                                @if ($menu_admin_sub->estado->id == '1' )
                                @if ($menu_admin_sub->role_id >= Auth::guard('admin_user')->user()->role_id )
                                  @if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)
                                    <li class="{{ current_page($menu_admin_sub->ruta) ? 'active': '' }}"><a href="{{ url($menu_admin_sub->ruta) }}">{{$menu_admin_sub->areas_item_admin->name}}</a></li>
                                  @endif
                                @endif
                                @endif
                              @endforeach
                            </ul>
                        </li>
                        @endif
                        @endif
                      @endif
                    @endforeach
                @endforeach 
            @endif
            @else(! Auth::guest())
                 @foreach ($menu_users as $menu_user)
                   @if ($menu_user->estado->id == '1' )
                   <li class="treeview
                     <?php
                       foreach ($menu_users_subs as $menu_users_sub)
                         {
                           if ($menu_users_sub->menu_user_id == $menu_user->area_id){
                             if (current_page($menu_users_sub->ruta)){
                                 echo ' active ';
                               }
                           }
                         }
                     ?>">
                         <a href="#"><i class='fa {{$menu_user->icono}}'></i><span>{{$menu_user->area->name}}</span> <i class="fa fa-angle-left pull-right"></i></a>
                         <ul class="treeview-menu">
                           @foreach ($menu_users_subs as $menu_users_sub)
                             @if ($menu_users_sub->estado->id == '1' )
                               @if ($menu_users_sub->menu_user_id == $menu_user->area_id)
                                 <li class="{{ current_page($menu_users_sub->ruta) ? 'active': '' }}"><a href="{{ url($menu_users_sub->ruta) }}">{{$menu_users_sub->areas_item->name}}</a></li>
                               @endif
                             @endif
                           @endforeach
                         </ul>
                     </li>
                   @endif
                 @endforeach
                 <li class="treeview">
                       <a href="{{ url ('atencion')}}"><i class='fa fa-user'></i><span>ESTADO DE CUENTA</span><i class="fa fa-angle-left pull-right"></i></a>
                 </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
