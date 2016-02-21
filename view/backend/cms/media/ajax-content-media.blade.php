<?php
if ( isset($model) ) {
  form()->setModel($model);
}
?>
{{ form()->open( ['files' => true] ) }}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Upload Image</h4>
</div>
<div class="modal-body">
  
  @if ( $errors->count() > 0 )
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    @foreach( $errors->all() as $message )
    <p>{{$message}}</p>
    @endforeach
  </div>
  @endif

  <div class="form-group">
    {{ form()->label('name', 'Title', ['class' => 'form-label']) }}
    {{ form()->text('name', null, ['class' => 'form-control']) }}
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('sort', 'Sort Order', ['class' => 'form-label']) }}
        {{ form()->text('sort_order', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ form()->label('upload', 'Upload', ['class' => 'form-label']) }}
        {{ form()->file('media') }}
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
  {{ form()->hidden('save', 1) }}
  {{ form()->hidden('action', request()->get('action')) }}
  {{ form()->hidden('content', request()->get('content')) }}
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button class="btn btn-primary" name="save">Save changes</button>
</div>
{{ form()->close() }}