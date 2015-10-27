@extends('layouts.master')

@section('content')

	{{-- Contorno da Licença --}}

	<section class="invoice">

		{{-- Cabeçalho --}}

		<div class="row">
			
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-globe"></i> {{ $licenca->tipo->descricao }} {{ $licenca->numero }}
					<small class="pull-right">Emissão: {{ implode("/", array_reverse(explode('-', $licenca->emissao))) }}</small>
				</h2>
			</div>

		</div>

		{{-- Informações --}}

		<div class="row invoice-info">
			
			<div class="col-sm-4 invoice-col">
				<strong>Empresa</strong> {{ $licenca->empresa->razao_social }}
				<br/>
				<strong>CNPJ:</strong> {{ $licenca->empresa->cnpj }}
				<br/>
				<strong>Contato:</strong> {{ $licenca->empresa->contato->nome }}
				<br/>
				<strong>Telefone:</strong> {{ $licenca->empresa->endereco_requerente->telefone }}
				<br/>
				<strong>Celular:</strong> {{ $licenca->empresa->endereco_requerente->celular }}
				<br/>
				<strong>Fax:</strong> {{ $licenca->empresa->endereco_requerente->fax }}
				<br/>
				<strong>E-mail:</strong> {{ $licenca->empresa->endereco_requerente->email }}
				<br/>

			</div>

			{{-- Dados da Licença --}}

			<div class="col-sm-4 invoice-col">
				<strong>Número: </strong> {{ $licenca->numero }}
				<br>
				<strong>Tipo: </strong> {{ $licenca->tipo->descricao }}
				<br>
				<strong>Emissão:</strong> {{ implode('/', array_reverse(explode('-', $licenca->emissao))) }}
				<br/>
				<strong>Validade:</strong> {{ implode('/', array_reverse(explode('-', $licenca->validade))) }}
				<br/>
				<strong>Status:</strong> {!! $licenca->statusTag('') !!}
				<br>
				<strong>Número do Processo</strong> {{ $licenca->n_processo }}
			</div>

		</div>

		{{-- Rodapé --}}

		<div class="row no-print">

			<a href="{{ route('empresas.show', ['empresas' => $licenca->empresa->id]) }}" class="btn btn-success">
			<i class="fa fa-eye"></i>
				Visualizar Empresa
			</a>

			<button class="btn btn-danger pull-right btn-excluir-licenca" data-toggle="modal" data-target="#modal-principal" data-licenca="{{ $licenca->id }}" data-titulo="{{ $licenca->id }}">
				<i class="fa fa-close"></i>
				Excluir
			</button>
			
			<a href="{{ route('licencas.edit', ['licencas' => $licenca->id]) }}" class="btn btn-info pull-right">
				<i class="fa fa-edit"></i>
				Editar
			</a>

		</div>

	</section>

@endsection