//////////////////////////////////////////////////////////////////////////////// Funções Gerais

var files;

var App = {};

// Faz a chamada ajax dos formulários de cadastro e alteração de usuários

function submitUsuarios(url, token, form, msg_sucesso)
{
	/// Obtem os dados do formulário

	var data = $(form).serializeArray();

	/// Inicia a chamada AJAX

	$.ajax(
	{
		url : url,
		headers : { 'X-CSRF-TOKEN' : token },
		type : 'POST',
		dataType : 'json',
		data : data,
		success : function(data)
		{
			var objeto = JSON.parse(data.objeto)

			// Não houve nenhum erro, criar uma div de sucesso para o usuário

			$("section.content").prepend('<div class="callout callout-success"><h4>Sucesso!</h4><p>'+msg_sucesso+'</p></div>');

			// Apagar todos os campos do formulário

			$(form)[0].reset();

			// Esconder o Ajax loader

			$("img.ajax-loader").css('display', 'none');

			// Rolar a página para cima

			$('html, body').animate({
		        scrollTop: 0
		    }, 500);
		},
		error : function(xhr, status, error)
		{
			// Houve algum erro de validação, mostrar esse erro ao usuário

			var erros = xhr.responseJSON;

			// Criar a div de alerta ao usuário

			$("section.content").prepend('<div class="callout callout-danger"><h4>Atenção!</h4></div>');

			// Popular essa div com os erros

			for(erro in erros)
			{
				$('section.content div.callout').append('<p>'+erros[erro][0]+'</p>');
			}

			console.log(xhr);

			// Esconder o Ajax loader

			$("img.ajax-loader").css('display', 'none');

			// Rolar a página para cima

			$('html, body').animate({
		        scrollTop: 0
		    }, 500);
		}
	});
}

function excluir(url, id, token, form)
{
	var resultado;
	
	$.ajax({
		url : url + '/' + id,
		headers : { 'X-CSRF-TOKEN' : token },
		type : 'POST',
		dataType : 'json',
		data : $(form).serializeArray(),
		success: function(data)
		{
			refresh();
		},
		error : function(xhr, status, error)
		{
			logar(dados);
		}
	});
}

function refresh()
{
	location.reload();
}

function logar(dados)
{
	console.log(dados);
}

//////////////////////////////////////////////////////////////////////////// Scripts rodados após o carregamento da página

$(function(){

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

		submitobjetos(url, token, $(this), "O usuário foi cadastrado no banco de dados.");

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Submit do form de Criação de empresas

	$("#form-create-empresa").submit(function(event){

		event.preventDefault();

		$("section.content div.callout").remove();

		$("img.ajax-loader").css('display', 'block')

		var url = $(this).attr('action');
		var token = $("input[name=_token]").val();

		submitUsuarios(url, token, $(this), "A empresa foi cadastrada no banco de dados.");

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

		submitUsuarios(url, token, $(this), "Usuário alterado com sucesso no banco de dados");

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

		submitUsuarios(url, token, $(this), "Empresa alterada com sucesso no banco de dados");

		return false;

	});

	//////////////////////////////////////////////////////////////////////////// Abrir o Modal de Exclusão de Usuário

	$(".btn-excluir-usuario").click(function(){

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

	$(".btn-excluir-empresa").click(function(){

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

});