<div class="user-panel">
    <div class="pull-left image">
         <img src="{{ asset('/img/avatar5.png') }}" class="img-circle" alt="User Image" />

    </div>
    <div class="pull-left info">
        <p>{{ Auth::guard('admin_user')->user()->name }}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
    </div>
</div>
