//////////////////////////////////////////////////////////////////////////////// Funções Gerais

var files;

var App = {};

function preparaForm(form)
{
	// Retirar qualquer aviso que tenha sido dado ao usuário

	$("section.content div.callout").remove();

	// Mostrar o Ajax-loader do lado do botão de enviar

	$("img.ajax-loader").css('display', 'block');

	// Obter a URL para ser usada na chamada AJAX

	var url = $(form).attr('action');
	var token = $("input[name=_token]").val();

	return { url : url, token : token };
}

// Faz a chamada ajax dos formulários de cadastro e alteração

function submitForm(url, token, form, msg_sucesso)
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
			console.log(xhr);

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

function adicionaUsuario(usuario)
{
	row =   '<tr>\
				<td>'+usuario.id+'</td>\
				<td>'+usuario.name+'</td>\
				<td>'+usuario.email+'</td>\
				<td>'+usuario.role.title+'</td>\
				<td>\
					<a href="'+users_path+'/'+usuario.id+'/edit" class="btn btn-primary btn-sm">\
						<i class="fa fa-edit"></i>\
					</a>\
					<button type="button" class="btn btn-danger btn-sm btn-excluir-usuario" data-toggle="modal" data-target="#modal-principal" data-user="'+usuario.id+'" data-name="'+usuario.name+'">\
						<i class="fa fa-close"></i>\
					</button>\
				</td>\
			</tr>';

	$("table.table.table-hover tbody").append(row);
}

////////////////////////////////////////////// Adiciona uma empresa na tabela

function adicionaEmpresa(empresa)
{
	$('table.table-hover tbody').append('\
		<tr>\
			<td>'+empresa.id+'</td>\
			<td>'+empresa.razao_social+'</td>\
			<td>'+empresa.cnpj+'</td>\
			<td>'+empresa.telefone+'</td>\
			<td>'+empresa.contato+'</td>\
			<td>\
				<a href="'+empresas_path+'/'+empresa.id+'/edit" class="btn btn-primary btn-sm">\
					<i class="fa fa-edit"></i>\
				</a>\
				<button type="button" class="btn btn-danger btn-sm btn-excluir-empresa" data-toggle="modal" data-target="#modal-principal" data-empresa="'+empresa.id+'" data-razao="'+empresa.razao_social+'">\
					<i class="fa fa-close"></i>\
				</button>\
			</td>\
		</tr>');
}

////////////////////////////////////////////// Adiciona uma licença na tabela

function adicionaLicenca(licenca)
{
	var emissao = licenca.emissao;
	var vencimento = licenca.validade;

	emissao = emissao.split('-').reverse().join('/');
	vencimento = vencimento.split("-").reverse().join('/');

	var hoje = new Date();
	var venc = new Date(licenca.validade);
	
	var data_max = new Date();
	data_max.setMonth(hoje.getMonth() + 6);

	var tag = '';

	if(venc < hoje)
	{
		if(licenca.renovada)
			tag = '<span class="label pull-right bg-blue">Renovada</span>';
		else
			tag = '<span class="label pull-right bg-red">Vencida</span>';
	}
	else if(venc >= hoje && venc <= data_max)
	{
		if(licenca.renovada)
			tag = '<span class="label pull-right bg-blue">Renovada</span>';
		else
			tag = '<span class="label pull-right bg-yellow">À Vencer</span>';
	}
	else
	{
		tag = '<span class="label pull-right bg-green">Ok</span>';
	}

	$('table.table-hover tbody').append('\
		<tr>\
			<td>'+licenca.id+'</td>\
			<td>'+licenca.razao_social+'</td>\
			<td>'+emissao+'</td>\
			<td>'+vencimento+' '+tag+'</td>\
			<td>\
				<a href="'+licencas_path+'/'+licenca.id+'/edit" class="btn btn-primary btn-sm">\
					<i class="fa fa-edit"></i>\
				</a>\
				<button type="button" class="btn btn-danger btn-sm btn-excluir-licenca" data-toggle="modal" data-target="#modal-principal" data-licenca="'+licenca.id+'" data-titulo="'+licenca.id+'">\
					<i class="fa fa-close"></i>\
				</button>\
			</td>\
		</tr>\
	');
}

function montarPaginacao(anterior, proximo, atual)
{
	var link_anterior;
	var link_proximo;
	var link_atual;

	//////////////////////////// Definir o link anterior

	if(anterior)
	{
		link_anterior = '<li><a class="ajax-pagination" href="'+anterior+'" rel="prev">«</a><li/>';
	}
	else
	{
		link_anterior = '<li class="disabled"><span>«</span></li>';
	}

	//////////////////////////// Definir o link posterior

	if(proximo)
	{
		link_proximo = '<li><a class="ajax-pagination" href="'+proximo+'" rel="next">»</a></li>';
	}
	else
	{
		link_proximo = '<li class="disabled"><span>»</span></li>';
	}

	//////////////////////////// Criar a paginação

	var paginacao = '<ul class="pagination">'+link_anterior+'\
		<li class="active">\
			<span>'+atual+'</span>\
		</li>'+link_proximo+'\
	</ul>';

	/////////////////////////////// Inserir na tabela

	$("div.mailbox-controls.footer-pagination .pagination").remove();

	$("div.mailbox-controls.footer-pagination").append(paginacao);
}

function paginarUsuarios(url)
{
	$.get(url, function(data){

		// Esvaziar a tabela

		$("table.table.table-hover tbody tr").remove();

		var resposta = JSON.parse(data);
		var row = '';

		// Preencher a tabela com os novos dados

		for(dado in resposta.data)
		{
			// Adicionar uma nova linha na tabela

			adicionaUsuario(resposta.data[dado]);
		}

		// Montar a paginação

		if(resposta.total >= resposta.per_page)
		{
			montarPaginacao(resposta.prev_page_url, resposta.next_page_url, resposta.current_page);
		}

	});
}

function paginarEmpresas(url)
{
	$.get(url, function(data){

		// Esvaziar a tabela

		$("table.table.table-hover tbody tr").remove();

		var resposta = JSON.parse(data);
		var row = '';

		// Preencher a tabela com os novos dados

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
}

function paginarLicencas(url, tipo)
{
	$.get(url, function(data){

		// Esvaziar a tabela

		$("table.table.table-hover tbody tr").remove();

		var resposta = JSON.parse(data);

		// Preencher a tabela com os novos dados

		for(dado in resposta.data)
		{
			adicionaLicenca(resposta.data[dado]);
		}

		// Montar a paginação

		if(resposta.total >= resposta.per_page)
		{
			montarPaginacao(resposta.prev_page_url, resposta.next_page_url, resposta.current_page);
		}

	});
}