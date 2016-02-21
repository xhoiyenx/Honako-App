@extends('auth.master')
@section('content')
  <div class="panel signin">
    <div class="panel-heading">
      <h1>{{ settings('site_title') }}</h1>
      <h4 class="panel-title">Administrator Login</h4>
    </div>
    <div class="panel-body">
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again.
      </div>
      {{ form()->open([ 'route' => 'app.login' ]) }}
        <div class="form-group mb10">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
            {{ form()->text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
          </div>
        </div>
        <div class="form-group nomargin">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
            {{ form()->password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
          </div>
        </div>
        <hr class="invisible">
        <div class="form-group">
          <button class="btn btn-success btn-quirk btn-block">Sign In</button>
        </div>
      {{ form()->close() }}
      <hr class="invisible">
    </div>
  </div><!-- panel -->
@stop