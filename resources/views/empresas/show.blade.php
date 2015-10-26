@extends('layouts.master')

@section('content')

	{{-- Contorno da Empresa --}}

	<section class="invoice">

		{{-- Cabeçalho --}}

		<div class="row">
			
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-globe"></i> {{ $empresa->razao_social }}
				</h2>
			</div>

		</div>

		{{-- Informações --}}

		<div class="row invoice-info">

			{{-- Dados da Empresa --}}

			<div class="col-sm-12 invoice-col">

				<div class="col-md-3">
					<strong>Id:</strong>
					<br/>
					<strong>Razão Social:</strong>
					<br>
					<strong>Nome Fantasia:</strong>
					<br/>
					<strong>CNPJ:</strong>
					<br/>
					<strong>Inscrição Estadual:</strong>
					<br>
					<strong>Telefone:</strong>
					<br>
					<strong>Fax:</strong>
					<br>
					<strong>Celular:</strong>
					<br>
					<strong>E-mail:</strong>
					<br>
					<br>
					<strong>Dados do Requerente</strong>
					<br>
					<br>
					<strong>Endereço:</strong>
					<br>
					<strong>Bairro:</strong>
					<br>
					<strong>Município:</strong>
					<br>
					<strong>UF:</strong>
					<br>
					<strong>CEP:</strong>
					<br>
					<br>
					<strong>Endereço do Empreendimento</strong>
					<br>
					<br>
					<strong>Endereço:</strong>
					<br>
					<strong>Bairro:</strong>
					<br>
					<strong>Município:</strong>
					<br>
					<strong>UF:</strong>
					<br>
					<strong>CEP:</strong>
					<br>
					<br>
					<strong>Endereço para Correspondência</strong>
					<br>
					<br>
					<strong>Endereço:</strong>
					<br>
					<strong>Bairro:</strong>
					<br>
					<strong>Município:</strong>
					<br>
					<strong>UF:</strong>
					<br>
					<strong>CEP:</strong>
					<br>
					<strong>Telefone:</strong>
					<br>
					<strong>Fax:</strong>
					<br>
					<strong>Celular:</strong>
					<br>
					<strong>E-mail:</strong>
					<br>
					<br>
					<strong>Representantes Legais</strong>
					<br>
					<br>
					<strong>Nome</strong>
					<br>
					<strong>CPF/RG</strong>
					<br>
					<strong>Telefone:</strong>
					<br>
					<strong>Fax:</strong>
					<br>
					<strong>Celular:</strong>
					<br>
					<strong>E-mail:</strong>
					<br>
					<br>
					<strong>Nome</strong>
					<br>
					<strong>CPF/RG</strong>
					<br>
					<strong>Telefone:</strong>
					<br>
					<strong>Fax:</strong>
					<br>
					<strong>Celular:</strong>
					<br>
					<strong>E-mail:</strong>
					<br>
					<br>
					<strong>Contato</strong>
					<br>
					<br>
					<strong>Nome</strong>
					<br>
					<strong>CPF/RG</strong>
					<br>
					<strong>Telefone:</strong>
					<br>
					<strong>Fax:</strong>
					<br>
					<strong>Celular:</strong>
					<br>
					<strong>E-mail:</strong>
				</div>

				<div class="col-md-9">
						
					{{ $empresa->id }}
					<br/>					
					{{ $empresa->razao_social }}
					<br>
					{{ $empresa->nome_fantasia }}
					<br/>
					{{ $empresa->cnpj }}
					<br/>
					{{ $empresa->inscricao_estadual }}
					<br>

					@if($empresa->endereco_requerente)

						{{ $empresa->endereco_requerente->telefone }}
						<br>
						{{ $empresa->endereco_requerente->fax }}
						<br>
						{{ $empresa->endereco_requerente->celular }}
						<br>
						{{ $empresa->endereco_requerente->email }}
						<br>
						<br> {{-- Dados do Requerente --}}
						<br>
						<br>
						{{ $empresa->endereco_requerente->logradouro }}
						<br>
						{{ $empresa->endereco_requerente->bairro }}
						<br>
						{{ $empresa->endereco_requerente->municipio }}
						<br>
						{{ $empresa->endereco_requerente->uf }}
						<br>
						{{ $empresa->endereco_requerente->cep }}

					@endif

					<br>
					<br><br> {{-- Endereço do Empreendimento --}}
					<br>

					@if($empresa->endereco_empreendimento)
						
						{{ $empresa->endereco_empreendimento->logradouro }}
						<br>
						{{ $empresa->endereco_empreendimento->bairro }}
						<br>
						{{ $empresa->endereco_empreendimento->municipio }}
						<br>
						{{ $empresa->endereco_empreendimento->uf }}
						<br>
						{{ $empresa->endereco_empreendimento->cep }}

					@endif

					<br>
					<br><br> {{-- Dados para Correspondência --}}
					<br>

					@if($empresa->endereco_correspondencia)

						{{ $empresa->endereco_correspondencia->logradouro }}
						<br>
						{{ $empresa->endereco_correspondencia->bairro }}
						<br>
						{{ $empresa->endereco_correspondencia->municipio }}
						<br>
						{{ $empresa->endereco_correspondencia->uf }}
						<br>
						{{ $empresa->endereco_correspondencia->cep }}
						<br>
						{{ $empresa->endereco_correspondencia->telefone }}
						<br>
						{{ $empresa->endereco_correspondencia->fax }}
						<br>
						{{ $empresa->endereco_correspondencia->celular }}
						<br>
						{{ $empresa->endereco_correspondencia->email }}

					@endif

					<br>
					<br><br> {{-- Representantes Legais --}}
					<br>

					@if($empresa->representante_1)

						{{ $empresa->representante_1->nome }}
						<br>
						{{ $empresa->representante_1->cpf_rg }}
						<br>
						{{ $empresa->representante_1->telefone }}
						<br>
						{{ $empresa->representante_1->fax }}
						<br>
						{{ $empresa->representante_1->celular }}
						<br>
						{{ $empresa->representante_1->email }}

					@endif
					<br>
					<br>

					@if($empresa->representante_2)

						{{ $empresa->representante_2->nome }}
						<br>
						{{ $empresa->representante_2->cpf_rg }}
						<br>
						{{ $empresa->representante_2->telefone }}
						<br>
						{{ $empresa->representante_2->fax }}
						<br>
						{{ $empresa->representante_2->celular }}
						<br>
						{{ $empresa->representante_2->email }}

					@endif

					<br>
					<br><br> {{-- Contato --}}
					<br>

					@if($empresa->contato)

						{{ $empresa->contato->nome }}
						<br>
						{{ $empresa->contato->cpf_rg }}
						<br>
						{{ $empresa->contato->telefone }}
						<br>
						{{ $empresa->contato->fax }}
						<br>
						{{ $empresa->contato->celular }}
						<br>
						{{ $empresa->contato->email }}

					@endif
						
					<br>
				</div>			

			</div>

		</div>

		{{-- Tabela de Licenças --}}

		<div class="row">
			
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-files-o"></i> Licenças
				</h2>
			</div>

		</div>

		<div class="row">
			
			<div class="col-xs-12 table-responsive">
				
				<table class="table table-striped table-hover">

					<thead>
						
						<tr>
							<th>ID</th>
							<th>Tipo</th>
							<th>Número</th>
							<th>Emissão</th>
							<th>Validade</th>
							<th>Status</th>
							<th>Ações</th>
						</tr>

					</thead>

					<tbody>

						@foreach($empresa->licencas as $licenca)

							<tr>
								<td>{{ $licenca->id }}</td>
								<td>{{ $licenca->tipo->sigla }}</td>
								<td>{{ $licenca->numero }}</td>
								<td>{{ implode("/", array_reverse(explode('-', $licenca->emissao))) }}</td>
								<td>{{ implode("/", array_reverse(explode('-', $licenca->validade))) }}</td>
								<td>
									{!! $licenca->statusTag('') !!}
								</td>
								<td>
									<a href="{{ route('licencas.show', ['licencas' => $licenca->id]) }}" class="btn btn-success btn-sm">
										<i class="fa fa-eye"></i>
										Visualizar
									</a>
								</td>
							</tr>

						@endforeach
						
					</tbody>

				</table>

			</div>

		</div>

		{{-- Rodapé --}}

		<div class="row no-print">

			<button class="btn btn-danger pull-right btn-excluir-empresa" data-toggle="modal" data-target="#modal-principal" data-empresa="{{ $empresa->id }}" data-razao="{{ $empresa->razao_social }}">
				<i class="fa fa-close"></i>
				Excluir
			</button>
			
			<a href="{{ route('empresas.edit', ['empresas' => $empresa->id]) }}" class="btn btn-info pull-right">
				<i class="fa fa-edit"></i>
				Editar
			</a>

		</div>

	</section>

@endsection