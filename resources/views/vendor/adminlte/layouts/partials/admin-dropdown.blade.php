<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <img src="{{ asset('/img/avatar5.png') }}" class="user-image" alt="User Image"/>
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">{{ Auth::guard('admin_user')->user()->name }}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
          <img src="{{ asset('/img/avatar5.png') }}" class="img-circle" alt="User Image" />
            <p>
                {{ Auth::guard('admin_user')->user()->name }}
                <small>{{ trans('adminlte_lang::message.login') }} {{$carbon->format('Y-m-d')}}</small>
            </p>
        </li>
        <!-- Menu Body -->

        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="{{ url('/admin_perfil') }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
            </div>
            <div class="pull-right">
                <a href="{{ url('/admin_logout') }}" class="btn btn-default btn-flat"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ trans('adminlte_lang::message.signout') }}
                </a>

                <form id="logout-form" action="{{ url('/admin_logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="submit" value="logout" style="display: none;">
                </form>

            </div>
        </li>
    </ul>
</li>
