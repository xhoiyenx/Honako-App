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
            {{ form()->label('name', 'Title') }}
            {{ form()->text('name', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ form()->label('description', 'Content') }}
            {{ form()->textarea('description', null, ['class' => 'wysiwyg']) }}
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                {{ form()->label('sort_order', 'Sort Order') }}
                {{ form()->text('sort_order', null, ['class' => 'form-control']) }}
              </div>
            </div>
            <div class="col-md-6">
              
            </div>
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

      <div class="panel panel-primary">
        <ul class="panel-options">
          <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
        </ul>
        <div class="panel-heading">
          <h3 class="panel-title">featured image</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            {{ form()->file('featured_image') }}
          </div>
          <div class="form-group">
            @if ( isset($featured_image) )
            <img src="{{ $featured_image->link }}" class="img-thumbnail">
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>
  @if ( isset($content) )
    {{ dump($content) }}
  @endif

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