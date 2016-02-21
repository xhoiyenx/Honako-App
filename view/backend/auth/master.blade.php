<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administrator Login</title>

  <!-- FONTS -->
  {{html()->style($assets . '/css/font-awesome.css')}}
  {{html()->style($assets . '/css/font.css')}}

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

<body class="signwrapper">

  <div class="sign-overlay"></div>
  <div class="signpanel"></div>

  @yield('content')
</body>
</html>
