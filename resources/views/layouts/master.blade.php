<?php $usuario = Auth::user(); ?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

	<title>Admin</title>
	<meta name="description" content="Área Administrativa">
	<meta name="author" content="CDTI - Prefeitura Municipal de Mesquita">
	
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	     folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

	{{-- Css principal da página --}}
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body class="hold-transition skin-blue">

  <div class="wrapper">
    
    {{-------------------------------- HEADER --------------------------------}}

    @include('includes.header')

    {{-------------------------------- SIDEBAR --------------------------------}}

    @include('includes.sidebar')

        {{-- Conteúdo principal --}}

        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              {{ $padrao['secao'] }}
              <small>{{ $padrao['subsecao'] }}</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Dashboard</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">

            {{-- Caso existam erros de validação, mostrar um 'callout' alertando o usuário --}}
            {{-- A variável 'errors' vem direto da validação do Laravel --}}

            @if(count($errors) > 0)

              <div class="callout callout-danger">

                <h4>Atenção!</h4>

                @foreach($errors->all() as $error)

                  <p>{{ $error }}</p>

                @endforeach

              </div>

            @endif
            
            <div class="row">
      
              @yield('content')

            </div>

          </section>

        </div>

        {{-------------------------------- SIDEBAR --------------------------------}}

        @include('includes.footer') 

  </div>

  @include('includes.modal')

  <script>

    // Caminhos básicos

    var users_path = "{{ route('users.index') }}";
    var licencas_path = "{{ route('licencas.index') }}";
    var empresas_path = "{{ route('empresas.index') }}";

  </script>
	
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('js/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('js/jquery.inputmask.extensions.js') }}"></script>
  <script src="{{ asset('js/icheck.min.js') }}"></script>
  <script src="{{ asset('js/app.min.js') }}"></script>
	<script src="{{ asset('js/functions.js') }}"></script>
  <script src="{{ asset('js/events.js') }}"></script>
</body>
</html>