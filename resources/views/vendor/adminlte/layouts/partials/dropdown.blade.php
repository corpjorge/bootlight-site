<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        @if(Auth::user()->avatar == '')
          <img src="{{ asset('/img/avatar0.png') }}" class="user-image" alt="User Image"/>
        @else
        <img src="{{ Auth::user()->avatar }}" class="user-image" alt="User Image"/>
        @endif
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        @if(Auth::user()->avatar == '')
        <span class="hidden-xs">{{ Auth::user()->name }}</span>
        @else
        <span class="hidden-xs">{{ Auth::user()->social_name }}</span>
        @endif
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
          @if(Auth::user()->avatar == '')
              <img src="{{ asset('/img/avatar0.png') }}" class="img-circle" alt="User Image" />
          @else
          <img src="{{  Auth::user()->avatar }}" class="img-circle" alt="User Image" />
          @endif
            <p>@if(Auth::user()->social_name == '')
                {{ Auth::user()->name }}
               @else
                {{ Auth::user()->social_name }}
               @endif
                <small>{{ trans('adminlte_lang::message.login') }} {{$carbon->format('Y-m-d')}}</small>
            </p>
        </li>
        <!-- Menu Body -->

        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="{{ url('/perfil') }}" class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
            </div>
            <div class="pull-right">
                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ trans('adminlte_lang::message.signout') }}
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    <input type="submit" value="logout" style="display: none;">
                </form>

            </div>
        </li>
    </ul>
</li>
