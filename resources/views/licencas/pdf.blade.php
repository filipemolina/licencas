<!doctype html>

<html lang="pt_BR">
<head>
 	
 	<meta charset="utf-8">

 	<title>Teste de PDF</title>
	
	<link type="text/css" media="all" rel="stylesheet" href="{{ public_path('css/pdf.css') }}">

</head>

<body class="{{ $classe }}">

	{{------------------------- Primeira Página -------------------------}}

	<div class="pagina page-break">

		{{-- Número da Licença --}}
		
		<div class="numero-licenca">{{ $licenca->tipo->sigla }}-SEMUAN Nº. {{ $licenca->numero }}</div>

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

			<div class="condicoes-gerais">Condições de Validade Gerais</div>

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

	{{------------------------- Segunda Página -------------------------}}

	<div class="pagina page-break">
		
		{{-- Número da Licença --}}
		
		<div class="numero-licenca">{{ $licenca->tipo->sigla }}-SEMUAN Nº. {{ $licenca->numero }}</div>

		<div class="condicoes">CONDIÇÕES DE VALIDADE DA LICENÇA</div>

		<div class="condicionantes">

			<ol class="cond" start="4">
				<li>Requerer a renovação desta licença no mínimo 120 (cento e vinte) dias antes do vencimento do seu prazo de validade, caso a implantação do projeto não seja concluída nesse prazo;</li>
				<li>Atender à Resolução nº. 001/90 do CONAMA, de 08.03.90, publicada no D.O.U. de 02.04.90, que dispõe sobre critérios e padrões de emissão de ruídos;</li>
				<li>Promover a limpeza periódica do sistema de fossa - filtro, utilizando os serviços de empresa licenciada pela <span style="font-weight: bold;">INEA – Instituto Estadual do Ambiente ou Prefeitura</span> para tal atividade, mantendo os comprovantes à disposição da fiscalização; </li>
				<li>Atender a NT 202 – Critérios e Padrões para lançamentos de efluentes líquidos, aprovada pela Deliberação CECA nº. 1.007, de 04.12.86, publicada no D.O.R.J. de 12.12.86; </li>
				<li>Atender a DZ 942 de 01.08.90 – Diretriz do Programa de Autocontrole de Efluentes, PROCON-ÁGUA, aprovada pela Deliberação CECA nº. 1.995, de 10.10.90, publicada no D.O.R.J. de 14.01.91;</li>
				<li>Não lançar quaisquer resíduos na rede de drenagem ou nos corpos d'água;</li>
				<li>Atender à DZ – 215. R-4 – Diretriz de Controle de Carga Orgânica Biodegradável em Efluentes líquidos de origens Sanitárias, aprovadas pela Deliberação CECA nº. 4.886 de 25.09.07 e publicada no D.O.R.J. de 05.10.07;</li>
				<li>Atender à DZ-1310.R-7 – Sistema de Manifesto de Resíduos, aprovada pela Deliberação CECA 4.497 de 03.09.04 e publicada no D.O.R.J. de 21.09.04;</li>
				<li>Apresentar a cada três meses, junto à SEMUAM/DLCA, o manifesto de resíduos emitidos por empresa licenciada pelo INEA;</li>
				<li>Apresentar a cada seis meses, junto à SEMUAM/DLCA, análise de efluentes realizada por empresa credenciada pelo INEA.</li>
				<li>Não realizar queima de qualquer material ao ar livre;</li>
				<li>Evitar todas as formas de acúmulo de água que possam propiciar a proliferação do mosquito <span style="font-weight: bold; text-decoration: underline; font-style: italic;">Aedes aegypti</span>, transmissor da dengue;</li>
				<li>Submeter previamente a SEMUAM/DLCA, para análise e parecer, qualquer alteração no projeto;</li>
				<li>São de responsabilidade da empresa todas as informações contidas neste processo;</li>
				<li>A SEMUAM/DLCA exigirá novas medidas de controle, sempre que julgar necessário;</li>
				<li>Seguir rigorosamente os padrões de segurança determinado pelo Corpo de Bombeiro do Estado do Rio de Janeiro, de acordo com o Laudo de Exigências;</li>
			</ol>
			
		</div>

		<div class="assinatura">
			<div>_____________________________________________</div>
			<div>ADAUTO JOSÉ PRADO DOS SANTOS</div>
			<div class="pequeno">SECRETÁRIO MUNICIPAL DE MEIO AMBIENTE</div>
			<div class="pequeno">MAT: 60/009.216</div>
		</div>

	</div>

	{{------------------------- Terceira Página -------------------------}}

	<div class="pagina page-break">
		
		{{-- Número da Licença --}}
		
		<div class="numero-licenca">{{ $licenca->tipo->sigla }}-SEMUAN Nº. {{ $licenca->numero }}</div>

		<div class="condicoes">CONDIÇÕES DE VALIDADE DA LICENÇA</div>

		<div class="condicionantes">

			<ol class="cond" start="20">
				<li>Os sistemas de controle deverão ser limpos regularmente de forma a garantir sua eficiência;</li>
				<li>Acondicionar os resíduos sólidos urbanos em sacos plásticos e conservá-los em recipiente com tampa até o seu recolhimento;</li>
				<li><span style="font-weigth: bold;">Não realizar no local outra atividade que não corresponda ao objeto desta licença;</span></li>
				<li>Os resíduos provenientes do sistema de controle deverão ser recolhidos por empresas licenciadas pelo Instituto Estadual do Ambiente – INEA/RJ;</li>
				<li><span style="font-weigth: bold;">Manter os equipamentos de segurança em perfeito estado de conservação;</span></li>
				<li>Qualquer impacto negativo ao meio ambiente, decorrente da implantação da atividade, a empresa estará sujeita as sanções previstas na Lei Municipal nº. 474 de 02.08.2008, mesmo após o encerramento de suas atividades;</li>
			</ol>
			
		</div>

		<div class="assinatura">
			<div>_____________________________________________</div>
			<div>ADAUTO JOSÉ PRADO DOS SANTOS</div>
			<div class="pequeno">SECRETÁRIO MUNICIPAL DE MEIO AMBIENTE</div>
			<div class="pequeno">MAT: 60/009.216</div>
		</div>

	</div>

	<div class="pagina-branca page-break">
		
		<img src="{{ public_path('img/brasao-mesquita.jpg') }}" alt="" class="brasao"/>

		<div class="texto-superior">
			<div>ESTADO DO RIO DE JANEIRO</div>
			<div>PREFEITURA MUNICIPAL DE MESQUITA</div>
			<div>Secretaria Municipal de Meio Ambiente e Agricultura - SEMUAM</div>
			<div>Departamento de Licenciamento e Controle Ambiental - D.L.C.A.</div>
		</div>

		{{-- Número da Licença --}}
		
		<div class="numero-licenca">{{ $licenca->tipo->sigla }}-SEMUAN Nº. {{ $licenca->numero }}</div>

		<div class="bloco-retirei">
			Retirei a original da Licença de Instalação {{ $licenca->tipo->sigla }}-SEMUAN Nº. {{ $licenca->numero }} e o modelo para publicação, referente ao Processo Administrativo 05/5521/15 autorizando a empresa <span style="text-transform: uppercase;">{{ $licenca->empresa->razao_social }}</span> a realizar Serviços de Engenharia. No seguinte local: {{ $licenca->empresa->endereco_empreendimento->logradouro }} - Bairro: {{ $licenca->empresa->endereco_empreendimento->bairro }} - {{ $licenca->empresa->endereco_empreendimento->municipio }}/{{ $licenca->empresa->endereco_empreendimento->uf }}.
		</div>

	</div>
  
</body>
</html>