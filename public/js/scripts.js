//////////////////////////////////////////////////////////////////////////////// Funções Gerais

var files;

// Faz a chamada ajax dos formulários de cadastro e alteração de usuários

function submitUsuarios(url, token, form, msg_sucesso)
{
	/// Obtem os dados do formulário

	var data = $(form).serializeArray();

	// Adicionar o arquivo da foto

	$.each(files, function(key, value)
    {
        data.push(key, value);
    });

	/// Inicia a chamada AJAX

	$.ajax(
	{
		url : url,
		headers : { 'X-CSRF-TOKEN' : token },
		type : 'POST',
		contentType : false,
		processData: false,
		dataType : 'json',
		data : data,
		success : function(data)
		{
			var usuario = JSON.parse(data.usuario)

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

//////////////////////////////////////////////////////////////////////////// Scripts rodados após o carregamento da página

$(function(){

	//////////////////////////////////////////////////////////////////////////// Incluir a foto nas requisições ajax

	$('input#foto').change(function(event){
		files = event.target.files;
	});

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

		submitUsuarios(url, token, $(this), "O usuário foi cadastrado no banco de dados.");

		return false;

	})

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

		$.ajax(
		{
			url : url,
			headers : { 'X-CSRF-TOKEN' : token },
			type : 'POST',
			dataType : 'json',
			data : $(this).serializeArray(),
			success : function(data)
			{
				var usuario = JSON.parse(data.usuario)

				// Não houve nenhum erro, criar uma div de sucesso para o usuário

				$("section.content").prepend('<div class="callout callout-success"><h4>Sucesso!</h4><p>Os dados do usuário '+usuario.name+' foram alterados no banco de dados.</p></div>');

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

				// Esconder o Ajax loader

				$("img.ajax-loader").css('display', 'none');

				// Rolar a página para cima

				$('html, body').animate({
			        scrollTop: 0
			    }, 500);
			}
		});

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

	});

	//////////////////////////////////////////////////////////////////////////// Excluir o usuário

	$("#modal-principal #btn-principal").click(function(){

		// Id do usuário à ser excluído

		var user_id = $(this).data('id');
		var url = $("form#form-excluir-usuario").attr('action');
		var token = $("form#form-excluir-usuario input[name=_token]").val();

		$("#form-excluir-usuario #user_id").val(user_id);


		$.ajax({
			url : url + '/' + user_id,
			headers : { 'X-CSRF-TOKEN' : token },
			type : 'POST',
			dataType : 'json',
			data : $("form#form-excluir-usuario").serializeArray(),
			success: function(data)
			{
				console.log("Sucesso");
				console.log(data);
			},
			error : function(xhr, status, error)
			{
				console.log("Fracasso");
				console.log(xhr);
			}
		});

	});

});