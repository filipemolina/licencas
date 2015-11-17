<!doctype html>

<html lang="pt_BR">
<head>
 	
 	<meta charset="utf-8">

 	<title>Teste de PDF</title>
	
	<link type="text/css" media="all" rel="stylesheet" href="{{ public_path('css/pdf.css') }}">

</head>

<body class="{{ $classe }}">

	{{-- Cada div.pagina.page-break corresponde à uma página do PDF --}}

	<div class="pagina page-break">

		{{-- Número da Licença --}}
		
		<div class="numero-licenca">LI-SEMUAN Nº. {{ $licenca->numero }}</div>

		{{-- Texto Inicial da Licença --}}

		<div class="texto-inicial">
			A Secretaria Municipal de Meio Ambiente – SEMUAM no uso das suas atribuições que lhe são conferidas pela Lei Municipal, 473 de 02 de setembro de 2008 e Considerando o teor do Decreto Estadual nº. 40.793 de 05/06/2007, que “Disciplina o Procedimento de Descentralização da Fiscalização e do Licenciamento Ambiental mediante celebração de Convênio assinado em 15/08/2008, concede a presente {{ $licenca->tipo->descricao }}, que autoriza”.
		</div>

		{{-- Dados principais --}}

		<div class="dados-principais">
			
			<div class="razao-social">NOME/RAZÃO SOCIAL</div>

			{{-- Box Razão Social e CNPJ --}}

			<div class="bloco-razao">
				<p>{{ $licenca->empresa->razao_social }}</p>
				<p>CNPJ nº. {{ $licenca->empresa->cnpj }}</p>
			</div>

			<div class="razao-social">ENDEREÇO</div>

			{{-- Box com a tabela de Endereço do Requerente --}}

			<div class="bloco-razao">
				<table>
					<tr>
						<td colspan="3">Logradouro: {{ $licenca->empresa->endereco_requerente->logradouro }}</td>
					</tr>
					<tr>
						<td>Bairro: {{ $licenca->empresa->endereco_requerente->bairro }}</td>
						<td>Cidade: {{ $licenca->empresa->endereco_requerente->municipio }}</td>
						<td>CEP: {{ $licenca->empresa->endereco_requerente->cep }}</td>
					</tr>
				</table>
			</div>

			{{-- Atividade --}}

			<div class="bloco-razao">
				<p>Serviços de Engenharia</p>
				<p class="pequeno">Em área construída de 8.011,30 m²</p>
			</div>

			{{-- Endereço da Atividade --}}

			<div class="bloco-endereco">
				<p><span class="pequeno">No seguinte local:</span> {{ $licenca->empresa->endereco_empreendimento->logradouro }} Bairro: {{ $licenca->empresa->endereco_empreendimento->bairro }} - {{ $licenca->empresa->endereco_empreendimento->municipio }} / {{ $licenca->empresa->endereco_empreendimento->uf }}</p>
			</div>

			<div class="condicoes">Condições de Validade Gerais</div>

			<div class="bloco-condicoes">
				<ol>
					<li>Publicar comunicado de recebimento desta licença no Diário Oficial do Município de Mesquita e em Jornal de grande Circulação no Estado, no prazo de 30 dias.</li>
					<li>Esta licença diz respeito aos aspectos ambientais e não exime o empreendedor do atendimento das demais licenças e autorizações federais, estaduais e municipais exigidas por lei;</li>
					<li>Esta Licença não poderá sofrer qualquer alteração, nem ser plastificada, sob pena de perder sua validade;</li>
				</ol>
			</div>

			<div class="texto-prazo">
				Esta Licença é válida até 07 de junho de 2017, por 02 (dois) anos, respeitadas as condições nela estabelecidas, e é concedida com base nos documentos e informações constantes do Processo SEMUAM nº. 05/5521/2015 e seus anexos.
			</div>

			<div class="texto-prazo data">
				Mesquita, 07 de junho de 2015.
			</div>

			<div class="assinatura">
				<div>_____________________________________________</div>
				<div>ADAUTO JOSÉ PRADO DOS SANTOS</div>
				<div class="pequeno">SECRETÁRIO MUNICIPAL DE MEIO AMBIENTE</div>
				<div class="pequeno">MAT: 60/009.216</div>
			</div>

		</div>

	</div>
  
</body>
</html>