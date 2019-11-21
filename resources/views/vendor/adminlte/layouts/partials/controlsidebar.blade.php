<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-question"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-info"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Consulta de ayuda</h3>


            @if (Auth::guard("admin_user")->user())
              @if(Auth::guard('admin_user')->user()->role_id == '1' OR Auth::guard('admin_user')->user()->role_id == '1')
                  @foreach ($menu_admins as $menu_admin)
                    @if ($menu_admin->estado->id == '1' )
                    <ul class='control-sidebar-menu'>
                      <li>
                        <a style="text-decoration: none;" >
                          <i class="menu-icon fa {{$menu_admin->icono}} bg-red"></i>
                          <div class="menu-info">
                            <h4 class="control-sidebar-subheading">{{$menu_admin->area_admin->name}}</h4>
                            @foreach ($menu_admin_subs as $menu_admin_sub)
                              @if ($menu_admin_sub->estado->id == '1' )
                                @if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)
                                  <p onmouseover="style.color = '#ada7a6'; style.cursor = 'pointer';" onmouseout="style.color = '#b8c7ce'" onclick="location.href = '{{ url('admin_help#'.$menu_admin_sub->ruta) }}'"  >
                                    {{$menu_admin_sub->areas_item_admin->name}}
                                  </p>
                                @endif
                              @endif
                            @endforeach
                          </div>
                        </a>
                      </li>
                    </ul>
                  @endif
              @endforeach
            @else

            @foreach ($adminpermisos as $adminpermiso)
              @foreach ($menu_admins as $menu_admin)
                @if ($menu_admin->estado->id == '1' )
                  @if ($adminpermiso->permiso_area_admin->id == $menu_admin->id )
                    <ul class='control-sidebar-menu'>
                      <li>
                        <a>
                          <i class="menu-icon fa {{$menu_admin->icono}} bg-red"></i>
                          <div class="menu-info">
                            <h4 class="control-sidebar-subheading">{{$menu_admin->area_admin->name}}</h4>
                            @foreach ($menu_admin_subs as $menu_admin_sub)
                              @if ($menu_admin_sub->estado->id == '1' )
                                @if ($menu_admin_sub->role_id > Auth::guard('admin_user')->user()->role_id )
                                  @if ($menu_admin_sub->menu_admin_id == $menu_admin->area_admin_id)
                                    <p onmouseover="style.color = '#ada7a6'; style.cursor = 'pointer';" onmouseout="style.color = '#b8c7ce'" onclick="location.href = '{{ url('admin_help#'.$menu_admin_sub->ruta) }}'"  >
                                      {{$menu_admin_sub->areas_item_admin->name}}
                                    </p>
                                  @endif
                                @endif
                              @endif
                            @endforeach
                          </div>
                        </a>
                      </li>
                    </ul>
                  @endif
                @endif
              @endforeach
            @endforeach

           @endif

          @else(! Auth::guest())
            @foreach ($menu_users as $menu_user)
              @if ($menu_user->estado->id == '1' )
                <ul class='control-sidebar-menu'>
                  <li>
                    <a>
                    <i class="menu-icon fa {{$menu_user->icono}} bg-red"></i>
                      <div class="menu-info">
                      <h4 class="control-sidebar-subheading">{{$menu_user->area->name}}</h4>
                      @foreach ($menu_users_subs as $menu_users_sub)
                        @if ($menu_users_sub->estado->id == '1' )
                          @if ($menu_users_sub->menu_user_id == $menu_user->area_id)
                            <p onmouseover="style.color = '#ada7a6'; style.cursor = 'pointer';" onmouseout="style.color = '#b8c7ce'" onclick="location.href = '{{ url('help#'.$menu_users_sub->ruta) }}'"  >
                              {{$menu_users_sub->areas_item->name}}
                            </p>
                          @endif
                        @endif
                      @endforeach
                      </div>
                    </a>
                  </li>
                </ul>
              @endif
            @endforeach
          @endif


        </div><!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab"></div><!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">Acerca de</h3>


                @if (Auth::guard("admin_user")->user())
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                      Oficina virtual
                    </label>
                    <p>Versión 2.2 Todos los derechos reservados</p>
                </div><!-- /.form-group -->
                @else(! Auth::guest())
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                      Oficina virtual
                    </label>
                    <p>Versión 2.2 Todos los derechos reservados</p>
                </div><!-- /.form-group -->
                @endif



            </form>
        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar

<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
