 ////////////// Scripts rodados após o carregamento da página

// As funções:
//		submitForm()
//		excluir()
//		refresh()
//		logar()
//		adicionaUsuarios()
//		adicionaEmpresa()
//		adicionaLicenca()
//		montarPaginacao()
//		paginarUsuarios()
//		paginarEmpresas()
//		paginarLicencas()

// Se encontram no arquivo "functions.js"

$(function(){

	//////////////////////////////////////////////////////////////////////////// Máscara de datas

	$("[data-mask]").inputmask();

	//////////////////////////////////////////////////////////////////////////// Personalização dos Checkboxes

	$("input[type=checkbox]").iCheck({checkboxClass: 'icheckbox_minimal-blue'});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Criação de usuários

	$("#form-create-user").submit(function(event)
	{
		// Evitar que o formulário seja enviado da forma tradicional

		event.preventDefault();

		// Retirar qualquer aviso que tenha sido dado ao usuário

		$('section.content div.callout').remove();

		// Mostrar o Ajax-loader ao lado do botão de enviar

		$("img.ajax-loader").css('display', 'block');

		// Obter a URL para ser usada na chamada AJAX

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		submitForm(url, token, $(this), "O usuário foi cadastrado no banco de dados.");

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Criação de empresas

	$("#form-create-empresa").submit(function(event){

		event.preventDefault();

		$("section.content div.callout").remove();

		$("img.ajax-loader").css('display', 'block');

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		submitForm(url, token, $(this), "A empresa foi cadastrada no banco de dados.");

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Criação de Licenças

	$("#form-create-licenca").submit(function(event){

		event.preventDefault();

		// Retirar qualquer aviso que tenha sido dado ao usuário

		$('section.content div.callout').remove();

		// Mostrar o Ajax-loader ao lado do botão de enviar

		$("img.ajax-loader").css('display', 'block');

		// Obter a URL para ser usada na chamada AJAX

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		submitForm(url, token, $(this), "A licença foi cadastrada no banco de dados.");

		return false;
	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Criação de Tipos de Licença

	$("#form-create-tipo").submit(function(event){

		event.preventDefault();

		// Retirar qualquer aviso que tenha sido dado ao usuário

		$('section.content div.callout').remove();

		// Mostrar o Ajax-loader ao lado do botão de enviar

		$("img.ajax-loader").css('display', 'block');

		// Obter a URL para ser usada na chamada AJAX

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		submitForm(url, token, $(this), "O Tipo de Licença foi cadastrado no banco de dados.");

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Alteração de usuários

	$("#form-edit-user").submit(function(event){

		// Evitar que o formulário seja enviado da forma tradicional

		event.preventDefault();

		// Retirar qualquer aviso que tenha sido dado ao usuário

		$('section.content div.callout').remove();

		// Mostrar o Ajax-loader ao lado do botão de enviar

		$("img.ajax-loader").css('display', 'block');	

		// Obter a URL para ser usada na chamada AJAX

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		// Iniciar a chamada AJAX

		submitForm(url, token, $(this), "Usuário alterado com sucesso no banco de dados");

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Alteração de empresas

	$("#form-edit-empresa").submit(function(event){

		event.preventDefault();

		// Retirar qualquer aviso que tenha sido dado ao usuário

		$("section.content div.callout").remove();

		// Mostrar o Ajax-loader do lado do botão de enviar

		$("img.ajax-loader").css('display', 'block');

		// Obter a URL para ser usada na chamada AJAX

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		// Iniciar a chamada AJAX

		submitForm(url, token, $(this), "Empresa alterada com sucesso no banco de dados");

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Alteração de Licença

	$("#form-edit-licenca").submit(function(event){
		
		event.preventDefault();

		// Retirar qualquer aviso que tenha sido dado ao usuário

		$("section.content div.callout").remove();

		// Mostrar o Ajax-loader do lado do botão de enviar

		$("img.ajax-loader").css('display', 'block');

		// Obter a URL para ser usada na chamada AJAX

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		// Iniciar a chamada AJAX

		submitForm(url, token, $(this), "Licença alterada com sucesso no banco de dados.");

		return false;
	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de alteração de Tipos de Licença

	$("#form-edit-tipo").submit(function(event){

		event.preventDefault();

		// Retirar qualquer aviso que tenha sido dado ao usuário

		$("section.content div.callout").remove();

		// Mostrar o Ajax-loader do lado do botão de enviar

		$("img.ajax-loader").css('display', 'block');

		// Obter a URL para ser usada na chamada AJAX

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		// Iniciar a chamada AJAX

		submitForm(url, token, $(this), "Tipo de Licença alterado com sucesso no banco de dados.", true);

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Abrir o Modal de Exclusão de Usuário

	$("table.table-hover").on('click', '.btn-excluir-usuario', function(){

		var user_id = $(this).data('user');
		var user_name = $(this).data('name')

		// Título do Modal

		$("#modal-principal h4").html('Atenção!');

		// Texto do corpo do modal

		$("#modal-principal .modal-body p").html("Tem certeza que deseja excluir o usuário " + user_name + " ?");

		// Texto do botão

		$("#modal-principal #btn-principal").removeClass('btn-primary').addClass('btn-danger').html('Excluir');

		$("#modal-principal #btn-principal").data('id', user_id);

		$("#modal-principal #btn-principal").addClass('excluir-usuario');

	});

	//////////////////////////////////////////////////////////////////////////// Excluir o usuário

	$("#modal-principal ").on('click', '.excluir-usuario', function(){

		// Id do usuário à ser excluído

		var user_id = $(this).data('id');
		var url = $("form#form-excluir-usuario").attr('action');
		var token = $("form#form-excluir-usuario input[name=_token]").val();

		$("#form-excluir-usuario #user_id").val(user_id);

		excluir(url, user_id, token, $("#form-excluir-usuario"));

	});

	//////////////////////////////////////////////////////////////////////////// Abrir o Modal de Exclusão de Empresa

	$("table.table-hover, section.invoice").on('click', '.btn-excluir-empresa', function(){

		var empresa_id = $(this).data('empresa');
		var razao = $(this).data('razao');

		// Título do Modal

		$("#modal-principal h4").html('Atenção!');

		// Texto do corpo do modal

		$("#modal-principal .modal-body p").html("Tem certeza que deseja excluir a empresa " + razao + " ?");

		// Texto do botão

		$("#modal-principal #btn-principal").removeClass('btn-primary').addClass('btn-danger').html('Excluir');

		$("#modal-principal #btn-principal").data('id', empresa_id);

		$("#modal-principal #btn-principal").addClass('excluir-empresa');

	});

	//////////////////////////////////////////////////////////////////////////// Excluir a Empresa

	$("#modal-principal").on('click', '.excluir-empresa', function(){
		
		// Id da empresa à ser excluída
		var empresa_id = $(this).data('id');

		// URL e Token para serem enviados por ajax
		var url = $("form#form-excluir-empresa").attr('action');
		var token = $("form#form-excluir-empresa input[name=_token]").val();

		$("#form-excluir-empresa #empresa_id").val(empresa_id);

		excluir(url, empresa_id, token, $("form#form-excluir-empresa"));

	});

	//////////////////////////////////////////////////////////////////////////// Abrir o modal de exclusão de licença

	$("table.table-hover, section.invoice").on('click', '.btn-excluir-licenca', function(){

		var licenca_id = $(this).data('licenca');
		var titulo = $(this).data('titulo');

		// Título do Modal

		$("#modal-principal h4").html("Atenção!");

		// Texto to corpo do modal

		$("#modal-principal .modal-body p").html("Tem certeza que deseja excluir a licença " + titulo + " ?");

		// Texto do botão

		$("#modal-principal #btn-principal").removeClass('btn-primary').addClass('btn-danger').html("Excluir");

		$("#modal-principal #btn-principal").data('id', licenca_id);

		$("#modal-principal #btn-principal").addClass('excluir-licenca');

	});

	/////////////////////////////////////////////////////////////////////////// Excluir Licença

	$("#modal-principal").on('click', '.excluir-licenca', function(){

		// Id da licença à ser excluída
		var licenca_id = $(this).data('id');

		// URL e Token para serem enviados por ajax
		var url = $("form#form-excluir-licenca").attr('action');
		var token = $("form#form-excluir-licenca input[name=_token]").val();

		$("#form-excluir-licenca #licenca_id").val(licenca_id);

		excluir(url, licenca_id, token, $("form#form-excluir-licenca"));

	});

	//////////////////////////////////////////////////////////////////////////// Abrir o modal de exclusão de Tipos

	$("table.table-hover, section.invoice").on('click', '.btn-excluir-tipo', function(){

		var tipo_id = $(this).data('tipo');
		var titulo = $(this).data('desc');

		// Título do Modal

		$("#modal-principal h4").html('Atenção!');

		// Texto do corpo do modal

		$("#modal-principal .modal-body p").html("Tem certeza que deseja excluir o tipo " + titulo + " ?");

		// Texto do botão

		$("#modal-principal #btn-principal").removeClass('btn-primary').addClass('btn-danger').html("Excluir");
		$("#modal-principal #btn-principal").data('id', tipo_id);
		$("#modal-principal #btn-principal").addClass('excluir-tipo');

	});

	/////////////////////////////////////////////////////////////////////////// Excluir Tipo

	$("#modal-principal").on('click', '.excluir-tipo', function(){

		// // Id do tipo à ser excluido
		var tipo_id = $(this).data('id');

		// URL e Token para serem enviados por ajax
		var url = $("form#form-excluir-tipo").attr('action');
		var token = $("form#form-excluir-tipo input[name=_token]").val();

		$("#form-excluir-tipo #tipo_id").val(tipo_id);

		excluir(url, tipo_id, token, $("form#form-excluir-tipo"));

	});

	/////////////////////////////////////////////////////////////////////////// Busca de Usuários

	$("input#busca-usuario").change(function(event){

		var termo = $(this).val();

		if(!termo)
		{
			termo = 0;
		}

		$.get(users_path + "/busca/" + termo, function(data){

			var resposta = JSON.parse(data);

			// Limpar a tabela e preencher com os novos dados

			$("table.table-hover tbody tr").remove();

			for(dado in resposta.data)
			{
				// Adicionar uma nova linha na tabela

				adicionaUsuario(resposta.data[dado]);
			}

			if(resposta.total >= resposta.per_page)
			{
				// Chamar a função que mostra a paginação via Ajax

				montarPaginacao(resposta.prev_page_url, resposta.next_page_url, resposta.current_page);
			}

		});

	});

	/////////////////////////////////////////////////////////////////////////// Busca de Empresas

	$("input#busca-empresa").change(function(event){

		var termo = $(this).val();

		if(!termo)
		{
			termo = '0';
		}

		$.get(empresas_path + "/busca/" + termo, function(data){

			var resposta = JSON.parse(data);

			// Limpar a tabela e preencher com os novos dados

			$("table.table-hover tbody tr").remove();

			for(dado in resposta.data)
			{
				// Adicionar uma nova linha na tabela

				adicionaEmpresa(resposta.data[dado]);
			}

			// Montar a paginação

			if(resposta.total >= resposta.per_page)
			{
				montarPaginacao(resposta.prev_page_url, resposta.next_page_url, resposta.current_page);
			}

		});

	});

	/////////////////////////////////////////////////////////////////////////// Busca de Licenças

	$("input#busca-licenca").change(function(event){

		var termo = $(this).val();
		var tipo = $(this).data('tipo').trim();
		var caminho = '';

		if(!termo)
		{
			termo = '0';
		}

		// Decidir se o usuário está pesquisando por licenças vencidas, à vencer, ou todas.

		if(tipo == 'avencer')
		{
			caminho = licencas_path + "/busca/" + termo + "/avencer";
		}
		else if(tipo == 'vencidas')
		{
			caminho = licencas_path + "/busca/" + termo + "/vencidas";	
		}
		else
		{
			caminho = licencas_path + "/busca/" + termo + "/todas";		
		}

		$.get(caminho, function(data){

			var resposta = JSON.parse(data);

			// Limpar a tabela e preencher com os novos dados

			$("table.table-hover tbody tr").remove();

			for(dado in resposta.data)
			{
				// Adicionar uma nova linha na tabela

				adicionaLicenca(resposta.data[dado]);
			}

			if(resposta.total > resposta.per_page)
			{
				montarPaginacao(resposta.prev_page_url, resposta.next_page_url, resposta.current_page);
			}

		});

	});

	////////////////////////////////////////////////////////// Paginação Ajax

	$(".mailbox-controls.footer-pagination").on('click', '.ajax-pagination', function(event){

		// Evitar que o link recarregue a página normalmente

		event.preventDefault();

		// Obter a URL do link para fazer a chamada Ajax

		var url = $(this).attr('href');

		// No caso das licenças, obter o tipo de lista (todas, renovadas ou vencidas)

		if($("input#busca-licenca").length)
		{
			var tipo = $("input#busca-licenca").data('tipo').trim();
		}

		// Obter o nome da seção em que o usuário se encontra removendo espaços vazio e caracteres de nova linha

		var secao = $(".content-header h1").html().trim().split(" ")[0].replace(/\r?\n|\r/g, "");

		// Decidir para qual controler enviar a requisição baseado no nome da seção

		if(secao == "Usuários")
		{
			paginarUsuarios(url);
		}
		else if(secao == "Empresas")
		{
			paginarEmpresas(url);
		}
		else if(secao == "Licenças")
		{
			paginarLicencas(url, tipo);
		}

	});

	//////////////////////////////////////////////////////////// Submit do form de mudar senha

	$("#form-mudar-senha").submit(function(event){

		// Evitar que o form seja submetido de forma tradicional

		event.preventDefault();

		// Preparar o formulário

		var dados = preparaForm($(this));

		// Envia os dados

		submitForm(dados.url, dados.token, $(this), "Senha alterada com sucesso!");

		// Evitar que o form seja submetido de forma tradicional

		return false;

	});

	////////////////////////////////////////////////////////////// Mostrar os resultados completos da pesquisa

	$("a.btn-pesquisa").click(function(event){

		event.preventDefault();

		// Obter as variáveis da pesquisa

		var termo = $("#termo-de-pesquisa").val();
		var objeto = $(this).data('object');
		var token = $("input[name=_token]").val();

		// Campos da tabela para cada tipo de pesquita

		var campos = {
			licencas : ['id', 'razao_social', 'validade'],
			empresas : ['id', 'razao_social', 'contato', 'telefone'],
			usuarios : ['id', 'name', 'email', 'title']
		};

		// Mostrar a tela de carregamento

		$("div.box").append('<div class="overlay">\
                  						<i class="fa fa-refresh fa-spin"></i>\
                					</div>');

		// Enviar a requisição da pesquisa e mostrar os dados

		$.post(base_path + "/buscaespecifica", { termo : termo, objeto : objeto, _token : token }, function(data){

			var resposta = JSON.parse(data);

			// Diminuir as abas com os outros resultados disparando um evento "click" nos "buttons" correspondentes

			$("div.parciais").children('div').not('.result-' + objeto).each(function(){

				if(!$(this).find('.box').hasClass('collapsed-box'))
				{
						$(this).find('button[data-widget=collapse]').trigger('click');
				}

			});

			// Esvaziar a tabela com os resultados

			$("div.parciais .result-" + objeto).find('table tbody tr').remove();

			// Preencher novamente a tabela

			var tabela = $("div.parciais .result-" + objeto).find('table tbody');

			// Definir o caminho da API para cada tipo de objeto

			var caminho = '';
			var classe ='';

			if(objeto == 'usuarios')
			{
				caminho = users_path;
			}
			else if(objeto == 'licencas')
			{
				caminho = licencas_path;
			}
			else if(objeto == 'empresas')
			{
				caminho = empresas_path;
			}

			// Iterar pelas linhas da tabela

			var linha = '<tr>';

			for(item in resposta)
			{
				// Iterar pelos campos da tabela

				for(campo in campos[objeto])
				{
					linha += '<td>' + resposta[item][campos[objeto][campo]] + '</td>';
				}

				// Adicionar o botão de editar

				linha += '<td>\
								<a href="'+caminho+'/'+resposta[item]['id']+'/edit" class="btn btn-primary btn-sm">\
									<i class="fa fa-edit"></i>\
								</a>\
							</td>';

				// Fechar a linha e abrir uma nova, caso não seja a última

				if(item == resposta.length - 1)
				{
					linha += '</tr>';
				}
				else
				{
					linha += '</tr><tr>';
				}
			}

			// Remover a tela de carregamento

			$("div.box .overlay").remove();

			// Inserir as novas linhas na tabela

			$(tabela).append(linha);

		});

	});

});