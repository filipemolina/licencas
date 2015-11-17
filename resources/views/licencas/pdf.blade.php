<!doctype html>

<html lang="pt_BR">
<head>
 	
 	<meta charset="utf-8">

 	<title>Teste de PDF</title>
	
	<link type="text/css" media="all" rel="stylesheet" href="{{ public_path('css/pdf.css') }}">

</head>

<body class="{{ $classe }}">

	<div class="pagina page-break">
		
		<div class="numero-licenca">LI-SEMUAN Nº. {{ $licenca->numero }}</div>

	</div>

	<div class="pagina page-break">
		
		<h1>Segundo Título</h1>

	</div>

	<div class="pagina page-break">
		
		<h1>Terceira página</h1>

		<h2>Teste</h2>

		<h3>Testando várias páginas</h3>

	</div>
  
</body>
</html>