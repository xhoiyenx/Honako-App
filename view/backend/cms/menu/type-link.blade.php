  <div class="form-group">
    {{ form()->label('url', 'Menu Link', ['class' => 'form-label']) }}
    <div class="input-group">
      <span class="input-group-addon">{{ url() }}</span>
      {{ form()->text('url', null, ['class' => 'form-control']) }}
    </div>
  </div>