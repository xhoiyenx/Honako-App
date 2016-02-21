<?php
$key = request()->has('configuration_key') ? request()->get('configuration_key') : request()->get('key');
?>
{{ form()->open() }}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">{{ $title or 'Content' }}</h4>
</div>
<div class="modal-body">
  
  <div class="form-group">
    {{ form()->label('title', 'Title', ['class' => 'form-label']) }}
    {{ form()->text( $key . '_title', settings($key . '_title'), ['class' => 'form-control']) }}
  </div>

  <div class="form-group">
    {{ form()->label('desc', 'Description', ['class' => 'form-label']) }}
    {{ form()->textarea( $key . '_desc', settings($key . '_desc'), ['class' => 'form-control wysiwyg']) }}
  </div>

  {{ form()->hidden('configuration_key', $key) }}
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button class="btn btn-primary">Save changes</button>
</div>
{{ form()->close() }}