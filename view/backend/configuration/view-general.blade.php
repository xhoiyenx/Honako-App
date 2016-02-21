

<div class="panel panel-inverse">
  <div class="panel-heading">
    <h3 class="panel-title">Site Information</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      {{ form()->label('site_title', 'Site Title', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('site_title', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ form()->label('site_description', 'Site Description', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('site_description', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ form()->label('site_copyright', 'Copyright', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('site_copyright', null, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>
  <div class="panel-heading">
    <h3 class="panel-title">Contact Information</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      {{ form()->label('site_address', 'Address', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('site_address', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ form()->label('site_contact_number', 'Contact Number', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->textarea('site_contact_number', null, ['class' => 'form-control', 'rows' => 4]) }}
      </div>
    </div>
    <div class="form-group">
      {{ form()->label('site_contact_email', 'Email', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('site_contact_email', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ form()->label('site_open_time', 'Open Time', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->textarea('site_open_time', null, ['class' => 'form-control', 'rows' => 4]) }}
      </div>
    </div>
  </div>
  <div class="panel-heading">
    <h3 class="panel-title">Social Links</h3>
  </div>
  <div class="panel-body">
    <div class="form-group">
      {{ form()->label('social_gplus', 'Goggle Plus', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('social_gplus', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ form()->label('social_facebook', 'Facebook', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('social_facebook', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ form()->label('social_twitter', 'Twitter', ['class' => 'control-label col-sm-3']) }}
      <div class="col-sm-8">
        {{ form()->text('social_twitter', null, ['class' => 'form-control']) }}
      </div>
    </div>
  </div>
</div>
