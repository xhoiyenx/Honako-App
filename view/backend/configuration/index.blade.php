@extends('includes.master')
@section('content')
  @include('includes.breadcrumb')
  @include('includes.messages')
  {{ form()->model( settings()->getAutoload(), [ 'route' => 'app.config', 'class' => 'form-horizontal', 'files' => true] ) }}

  <div class="row">
    <div class="col-md-3 col-lg-2">
      <button class="btn btn-primary btn-quirk btn-block mb20">Save Configuration</button>
      <div class="panel">
        <div class="nav-wrapper quirk">
          <ul class="nav nav-pills nav-stacked nav-quirk nav-dark-quirk nomargin">
            <li class="{{ url_active( route('configuration') ) }}">
              <a href="{{ route('configuration') }}"><span>General</span></a>
            </li>
            <li class="{{ url_active( route('configuration', ['type' => 'content']) ) }}">
              <a href="{{ route('configuration', ['type' => 'content']) }}"><span>Content</span></a>
            </li>
          </ul>
        </div>
      </div>      
    </div>

    <div class="col-md-9 col-lg-10">
      @include( $show )
    </div>
  </div>
  {{ form()->close() }}
@endsection

@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {
  $('.config-cms').click(function(event) {
    event.preventDefault();

    $.post( '{{ route('configuration.ajax_content') }}',
    {
      key: $(this).data('key'),
      title: $(this).html()
    }, 
    function(data) {
      $('.modal-content').html(data);
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
            text: 'Content saved',
            class_name: 'with-icon check-circle'
          });
          $('.modal').modal('hide');
        }
        else {
          $('.modal-content').html(data);
        }
      }
    });
  });

  $( document ).ajaxComplete(function() {
    $('.wysiwyg').redactor({
      plugins: ['fullscreen', 'imagemanager'],
      imageUpload: '{{ route('app.upload') }}?type=redactor',
      minHeight: 300
    });    
  });

});  
</script>
@endsection