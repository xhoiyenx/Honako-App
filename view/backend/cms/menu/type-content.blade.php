  <?php
  /** 
   * This is content type only layout, only shows on edit
   */
  $content = $page_repo->find( $data->object_id );
  ?>
  <div class="form-group">
    {{ form()->select('object_id', $page_repo->getByType($content->type)->lists('name', 'id'), null, ['class' => 'form-control select2']) }}
  </div>
