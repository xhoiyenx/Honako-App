@extends('includes.master')
@section('content')
@include('includes.breadcrumb')

{{ $form_open }}
  @include('includes.messages')


  <div class="row">
    <div class="col-sm-8 col-md-9">

      @if ( isset($gallery) )
      <?php
      $images = $gallery->media;
      ?>
      <div class="panel panel-inverse-full">
        <ul class="panel-options">
          <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
        </ul>
        <div class="panel-heading">
          <h3 class="panel-title">Gallery</h3>
        </div>
        <div class="panel-body">
          <div class="panel-actions">
            <a href="{{ route('app.content.media', [$gallery->id]) }}" data-id="{{ $gallery->id }}" data-action="insert" class="btn btn-success btn-quirk show-form">upload image</a>
          </div>



          <div class="row filemanager">

            @foreach( $images as $image )
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
              <div class="thmb">
                <div class="btn-group fm-group">
                  <button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu pull-right fm-menu" role="menu">
                    <li><a href="{{ route('app.content.media', [$gallery->id]) }}" data-id="{{ $image->id }}" data-action="update" class="show-form"><i class="fa fa-pencil"></i> Edit</a></li>
                    <li><a href="{{ route('app.content.media', [$gallery->id]) }}" data-id="{{ $image->id }}" data-action="delete" class="show-form"><i class="fa fa-trash-o"></i> Delete</a></li>
                  </ul>
                </div><!-- btn-group -->
                <div class="thmb-prev">
                  <img src="{{ app('honako')->getImage( $image->link, 'small' ) }}" class="img-responsive" alt="" />
                </div>
              </div><!-- thmb -->
            </div><!-- col-xs-6 -->
            @endforeach

          </div><!-- row -->

        </div>
      </div>
      @endif

      <div class="panel panel-primary">
        <ul class="panel-options">
          <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
        </ul>
        <div class="panel-heading">
          <h3 class="panel-title">General Info</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            {{ form()->label('name', 'Title') }}
            {{ form()->text('name', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ form()->label('description', 'Description') }}
            {{ form()->textarea('description', null, ['class' => 'form-control wysiwyg']) }}
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
    minHeight: 200
  });

  $('.show-form').click(function(event) {
    event.preventDefault();

    $.post( $(this).attr('href'),
    {
      content: $(this).data('id'),
      action: $(this).data('action'),
    },
    function(data) {
      if ( data == 2 ) {
        $.gritter.add({
          title: 'Success',
          text: 'Media data deleted',
          class_name: 'with-icon check-circle'
        });
        window.location.href = '{{ request()->url() }}';
      }
      else {
        $('.modal-content').html(data);
      }
    });
    $('.modal').modal('show');

  });

  /**
   * Submit Form Add/Edit
   */
  $('.modal-content').on('submit', 'form', function(event) {
    event.preventDefault();
    $.ajax({
      url: $(this).attr('action'), 
      type: 'POST',             
      data: new FormData($(this)[0]),
      contentType: false,       
      cache: false,             
      processData:false,        
      success: function(data) {
        if ( data == 1 ) {
          $.gritter.add({
            title: 'Success',
            text: 'Media data saved',
            class_name: 'with-icon check-circle'
          });
          $('.modal').modal('hide');

          window.location.href = '{{ request()->url() }}';
        }
        else {
          $('.modal-content').html(data);
        }
      }
    });
  });

  $('.thmb').hover(function(){
    var t = $(this);
    t.find('.ckbox').show();
    t.find('.fm-group').show();
  }, function() {
    var t = $(this);
    if(!t.closest('.thmb').hasClass('checked')) {
      t.find('.ckbox').hide();
      t.find('.fm-group').hide();
    }
  });  


});  
</script>
@endsection