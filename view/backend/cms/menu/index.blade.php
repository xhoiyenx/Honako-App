@extends('includes.master')
@section('content')
  @include('includes.breadcrumb')
  @include('includes.messages')

<form>
  <div class="row">
    <div class="col-md-3 col-lg-2">
      
      <div class="panel panel-inverse-full">
        <div class="panel-heading">
          <h3 class="panel-title">Select Menu</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">
            {{ form()->select('code', $menus, $current_menu, ['class' => 'form-control', 'style' => 'width:100%', 'id' => 'menu_select']) }}
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-success btn-quirk btn-block btn-save-menu">save changes <i style="display:none" class="fa fa-refresh fa-spin"></i></button>
          </div>
        </div>
      </div>

      <h5>ASSIGN CONTENT</h5>
      <div class="panel-group" id="menu-content">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#menu-content" href="#pages">
                Pages
              </a>
            </h4>
          </div>
          <div id="pages" class="panel-collapse collapse in">
            <div class="panel-body">
              <div class="form-group">
                {{ form()->select('page_list', $page_select, null, ['class' => 'form-control', 'style' => 'width:100%', 'id' => 'page_select', 'data-placeholder' => 'Select a page']) }}
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success btn-quirk btn-block btn-add-page-to-menu">add to menu</button>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="collapsed" data-toggle="collapse" data-parent="#menu-content" href="#services">
                Services
              </a>
            </h4>
          </div>
          <div id="services" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="form-group">
                {{ form()->select('page_list', $service_select, null, ['class' => 'form-control', 'style' => 'width:100%', 'id' => 'service_select', 'data-placeholder' => 'Select a page']) }}
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success btn-quirk btn-block btn-add-service-to-menu">add to menu</button>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="col-md-9 col-lg-10">

      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title">{{ $menus[$current_menu] }}</div>
        </div>
        <div class="panel-body">
          
          <div class="panel-actions">
            <button type="button" class="btn btn-success btn-quirk show-form">add new</button>
          </div>

          <div class="menu-nestable">
          </div>

          <div class="debug"></div>

        </div>
      </div>
      
    </div>    
  </div>
</form>

@endsection
@section('before_footer')
{{html()->script($assets . '/js/jquery.nestable.js')}}
@endsection

@section('after_footer')
<script type="text/javascript">
function show_menu( current_menu )
{
  $.post('/{{ config('app.backend_route_prefix') }}/cms/menu/ajax', 
    {
      action: 'menu_get',
      menu: current_menu
    }, 
    function(data, textStatus, xhr) {
      $('.menu-nestable').html(data);
    }
  );
}

$(document).ready(function() {

  var current_menu = $('#menu_select').val();

  // on load show menu
  show_menu( current_menu );

  $('#menu_select').change(function(event) {
    document.location.href = '{{ route('cms.menu') }}/' + $(this).val();
  });

  $('.show-form').click(function(event) {
    $.post('{{ route('cms.menu.form') }}',
    {
      code: current_menu
    }, 
    function(data) {
      $('.modal-content').html(data);
    });
    $('.modal').modal('show');
  });

  $('.menu-nestable').on('click', '.menu-edit', function(event) {

    event.preventDefault();
    $.post('{{ route('cms.menu.form') }}/' + $(this).data('id'),
    {
      id: $(this).data('id')
    }, 
    function(data) {
      $('.modal-content').html(data);
      $('.modal').modal('show');
    });
    
  });

  $('.menu-nestable').on('click', '.menu-delete', function(event) {
    
    event.preventDefault();
    $.post('/{{ config('app.backend_route_prefix') }}/cms/menu/ajax', 
    {
      action: 'menu_delete',
      id: $(this).data('id'),
    }, 
    function(data, textStatus, xhr) {
      show_menu( current_menu );
      $.gritter.add({
        title: 'Success',
        text: 'Menu deleted',
        class_name: 'with-icon check-circle'
      });
    });
    
  });

  $('.btn-add-page-to-menu').click(function(event) {
    $.post('/{{ config('app.backend_route_prefix') }}/cms/menu/ajax', 
    {
      action: 'menu_add',
      type: 'content',
      id: $('#page_select').val(),
      menu: current_menu
    }, 
    function(data, textStatus, xhr) {
      show_menu( current_menu );
      $.gritter.add({
        title: 'Success',
        text: 'Menu added',
        class_name: 'with-icon check-circle'
      });
    });
  });

  $('.btn-add-service-to-menu').click(function(event) {
    $.post('/{{ config('app.backend_route_prefix') }}/cms/menu/ajax', 
    {
      action: 'menu_add',
      type: 'content',
      id: $('#service_select').val(),
      menu: current_menu
    }, 
    function(data, textStatus, xhr) {
      show_menu( current_menu );
      $.gritter.add({
        title: 'Success',
        text: 'Menu added',
        class_name: 'with-icon check-circle'
      });
    });
  });

  $('.btn-save-menu').click(function(event) {
    $(this).find('.fa').show();
    $.post('/{{ config('app.backend_route_prefix') }}/cms/menu/ajax', 
      {
        action: 'menu_sort',
        position: $('.dd').nestable('serialize'),
        menu: current_menu
      }, 
      function(data, textStatus, xhr) {
        $('.debug').html(data);
        $('.btn-save-menu').find('.fa').hide();

        $.gritter.add({
          title: 'Success',
          text: 'Menu position saved',
          class_name: 'with-icon check-circle'
        });
      }
    );
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
            text: 'Menu saved',
            class_name: 'with-icon check-circle'
          });
          $('.modal').modal('hide');
          show_menu( current_menu );
        }
        else {
          $('.modal-content').html(data);
        }
      }
    });
  });

  $(document).ajaxComplete( function(event) {
    $('.dd').nestable({
      maxDepth: 2
    });
  });


});
</script>
@endsection