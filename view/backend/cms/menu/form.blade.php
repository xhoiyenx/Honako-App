{{ form()->model($data) }}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Menu</h4>
</div>
<div class="modal-body">
  
  <div class="form-group">
    {{ form()->label('name', 'Menu Name', ['class' => 'form-label']) }} *
    {{ form()->text('name', null, ['class' => 'form-control']) }}
  </div>

  @if( $data->type == 'content' )
    @include('cms.menu.type-content')
  @else
    @include('cms.menu.type-link')
  @endif

  <div class="form-group">
    <label class="ckbox ckbox-primary">
      <input type="checkbox"><span>Open in new tab</span>
    </label>
  </div>

  {{ form()->hidden('id', null) }}
  {{ form()->hidden('code', null) }}
  {{ form()->hidden('save', 1) }}
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button class="btn btn-primary">Save changes</button>
</div>
{{ form()->close() }}