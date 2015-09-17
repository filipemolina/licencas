//////////////////////////////////////////////////////////////////////////////// Funções Gerais

// Faz a chamada ajax dos formulários de cadastro e alteração de usuários

function submitUsuarios(url, token, form, msg_sucesso)
{
	/// Inicia a chamada AJAX

	$.ajax(
	{
		url : url,
		headers : { 'X-CSRF-TOKEN' : token },
		type : 'POST',
		dataType : 'json',
		data : $(form).serializeArray(),
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

			// Esconder o Ajax loader

			$("img.ajax-loader").css('display', 'none');

			// Rolar a página para cima

			$('html, body').animate({
		        scrollTop: 0
		    }, 500);
		}
	});
}

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

});