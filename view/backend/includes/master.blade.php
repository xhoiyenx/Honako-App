<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title></title>

  <!-- FONTS -->
  {{html()->style($assets . '/css/font-awesome.css')}}
  {{html()->style($assets . '/css/font.css')}}

  <!-- PLUGIN -->
  {{html()->style($assets . '/lib/redactor/redactor.css')}}
  {{html()->style($assets . '/lib/jquery.gritter/jquery.gritter.css')}}
  {{html()->style($assets . '/css/select2.css')}}

  <!-- CORE -->
  {{html()->style($assets . '/css/style.css')}}
  {{html()->style($assets . '/css/custom.css')}}
  {{html()->script($assets . '/js/modernizr.js')}}

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="../lib/html5shiv/html5shiv.js"></script>
  <script src="../lib/respond/respond.src.js"></script>
  <![endif]-->
</head>

<body>

  <header>
    <div class="headerpanel">

      <div class="logopanel">
        <h2><a href="index.html">HONAKO</a></h2>
      </div><!-- logopanel -->

      <div class="headerbar">

        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

        <div class="header-right">
          <ul class="headermenu">
            <li>
              <div class="btn-group">
                <button type="button" class="btn btn-logged" data-toggle="dropdown">
                  My Account
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                  <li><a href="profile.html"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                  <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                  <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                  <li><a href="signin.html"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                </ul>
              </div>
            </li>
            <li>
              <button id="chatview" class="btn btn-chat alert-notice">
                <span class="badge-alert"></span>
                <i class="fa fa-comments-o"></i>
              </button>
            </li>
          </ul>
        </div><!-- header-right -->
      </div><!-- headerbar -->
    </div><!-- header-->
  </header>

  <section>

    <div class="leftpanel">
      <div class="leftpanelinner">

        <!-- ################## LEFT PANEL PROFILE ################## -->

        <ul class="nav nav-tabs nav-justified nav-sidebar">
          <li class="tooltips active" data-placement="bottom" data-toggle="tooltip" title="Main Menu"><a data-toggle="tab" data-target="#mainmenu"><i class="tooltips fa fa-ellipsis-h"></i></a></li>
          <li class="tooltips unread" data-placement="bottom" data-toggle="tooltip" title="Check Mail"><a data-toggle="tab" data-target="#emailmenu"><i class="tooltips fa fa-envelope"></i></a></li>
          <li class="tooltips" data-placement="bottom" data-toggle="tooltip" title="Log Out"><a href="signin.html"><i class="fa fa-sign-out"></i></a></li>
        </ul>

        <div class="tab-content">

          <!-- ################# MAIN MENU ################### -->

          <div class="tab-pane active" id="mainmenu">
          @include('includes.mainmenu')
          </div>

          <!-- ######################## EMAIL MENU ##################### -->

          <div class="tab-pane" id="emailmenu">
            <div class="sidebar-btn-wrapper">
              <a href="compose.html" class="btn btn-danger btn-block">Compose</a>
            </div>

            <h5 class="sidebar-title">Mailboxes</h5>
            <ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
              <li><a href="email.html"><i class="fa fa-inbox"></i> <span>Inbox (3)</span></a></li>
              <li><a href="email.html"><i class="fa fa-pencil"></i> <span>Draft (2)</span></a></li>
              <li><a href="email.html"><i class="fa fa-paper-plane"></i> <span>Sent</span></a></li>
            </ul>

            <h5 class="sidebar-title">Tags</h5>
            <ul class="nav nav-pills nav-stacked nav-quirk nav-label">
              <li><a href="#"><i class="fa fa-tags primary"></i> <span>Communication</span></a></li>
              <li><a href="#"><i class="fa fa-tags success"></i> <span>Updates</span></a></li>
              <li><a href="#"><i class="fa fa-tags warning"></i> <span>Promotions</span></a></li>
              <li><a href="#"><i class="fa fa-tags danger"></i> <span>Social</span></a></li>
            </ul>
          </div><!-- tab-pane -->

        </div><!-- tab-content -->

      </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->

    <div class="mainpanel">

      <div class="contentpanel">

        <!--
        <ol class="breadcrumb breadcrumb-quirk">
          <li><a href="index.html"><i class="fa fa-home mr5"></i> Home</a></li>
          <li><a href="buttons.html">Pages</a></li>
          <li class="active">Blank</li>
        </ol>
        -->

        @yield('content')

      </div><!-- contentpanel -->
    </div><!-- mainpanel -->
  </section>

  <!-- default modal -->
  <div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      </div>
    </div>
  </div>

  {{html()->script($assets . '/js/jquery-2.1.4.min.js')}}
  {{html()->script($assets . '/js/bootstrap.min.js')}}
  {{html()->script($assets . '/lib/redactor/redactor.min.js')}}
  {{html()->script($assets . '/lib/jquery.gritter/jquery.gritter.js')}}
  {{html()->script($assets . '/js/select2.js')}}
  @section('before_footer')@show
  {{html()->script($assets . '/js/script.js')}}
  @section('after_footer')@show
</body>
</html>
