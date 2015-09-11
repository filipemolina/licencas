<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title></title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
	
	<link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo asset('css/bootstrap-theme.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo asset('css/styles.css'); ?>">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body>

	<div class="container">
		
		@yield('content')

	</div>
	
	<script src="<?php echo asset('js/jquery.min.js'); ?>"></script>
	<script src="<?php echo asset('js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo asset('js/scripts.js'); ?>"></script>
</body>
</html>