@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Mantenimiento de usuarios participantes APOYANDO Y GANANDO</h3>
        </div>
        <br>
        <div class="box-body">
          <div class="row">

            <a href="{{url('excel')}}">

                  <div class="col-sm-6 col-xs-12">

                    <div class="info-box">

                      <span class="info-box-icon bg-green"><i class="fa fa-download"></i></span>

                      <div class="info-box-content">

                        <span class="info-box-text">Descargar usuarios (Excel)</span>

                      </div>

                    </div>

                  </div>

            </a>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
</section>


@endsection
