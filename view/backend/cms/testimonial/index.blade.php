@extends('includes.master')
@section('content')
@include('includes.breadcrumb')
@include('includes.messages')
<div class="panel-actions">
  <a href="{{ route('cms.testimonial.create') }}" class="btn btn-success btn-quirk">add new</a>
  <a href="{{ route('configuration.ajax_content') }}" class="btn btn-success btn-quirk show-form">edit content</a>  
</div>
<table class="table table-custom table-hover table-cms no-margin">
  <thead>
    <tr>
      <th>Name</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  @if ( ! $contents->isEmpty() )
  <tbody>
    @foreach ( $contents as $content )
    <tr>
      <td>
        <a href="{{ route('cms.testimonial.update', [$content->id]) }}">{{$content->name}}</a>
      </td>
      <td>
        <ul class="table-options">
          <li><a href="{{ route('cms.testimonial.update', [$content->id]) }}"><i class="fa fa-pencil"></i></a></li>
          <li><a href="{{ action('App\Controller\Manager\Cms\Page@delete', [$content->id]) }}"><i class="fa fa-trash"></i></a></li>
        </ul>        
      </td>
    </tr>
    @endforeach
  </tbody>
  @else
  <tbody>
    <tr>
      <td colspan="10">No Data Found</td>
    </tr>
  </tbody>
  @endif
</table>
@endsection

@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {
  $('.show-form').click(function(event) {
    event.preventDefault();

    $.post( $(this).attr('href'),
    {
      key: 'content_testimonial'
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
            text: 'Service content saved',
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