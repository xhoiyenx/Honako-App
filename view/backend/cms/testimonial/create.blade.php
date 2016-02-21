@extends('includes.master')
@section('content')
@include('includes.breadcrumb')

{{ $form_open }}
  @include('includes.messages')
  <div class="row">
    <div class="col-sm-8 col-md-9">

      <div class="panel panel-primary">
        <ul class="panel-options">
          <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
        </ul>
        <div class="panel-heading">
          <h3 class="panel-title">General</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            {{ form()->label('name', 'Author') }}
            {{ form()->text('name', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ form()->label('description', 'Quote') }}
            {{ form()->textarea('description', null, ['class' => 'form-control']) }}
          </div>

        </div>
      </div>

    </div>
    <div class="col-sm-4 col-md-3">

      <div class="panel panel-success">
        <ul class="panel-options">
          <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
        </ul>
        <div class="panel-heading">
          <h3 class="panel-title">actions</h3>
        </div>
        <div class="panel-body">
          
          <div class="col-md-6">
            <button class="btn btn-success btn-quirk btn-stroke btn-block">save</button>
          </div>

          <div class="col-md-6">
            <a href="{{ app('url')->previous() }}" class="btn btn-default btn-quirk btn-block">cancel</a>
          </div>

        </div>
      </div>

    </div>
  </div>

  {{ form()->hidden('id', null) }}
{{ form()->close() }}
@endsection

@section('before_footer')
@append

@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {
  /**
   * INIT WYSIWYG
   */
  $('.wysiwyg').redactor({
    plugins: ['fullscreen', 'imagemanager'],
    imageUpload: '{{ route('app.upload') }}?type=redactor',
    minHeight: 300
  });    
});  
</script>
@endsection