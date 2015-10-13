@extends('layouts.master')

@section('content')

	{{-- Contorno da Licença --}}

	<section class="invoice">

		{{-- Cabeçalho --}}

		<div class="row">
			
			<div class="col-xs-12">
				<h2 class="page-header">
					<i class="fa fa-globe"></i> Licença Ambiental {{ $licenca->id }}
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
				<strong>E-mail:</strong> {{ $licenca->empresa->email }}
				<br/>
				<strong>Contato:</strong> {{ $licenca->empresa->contato }}
				<br/>
				<strong>Telefone:</strong> {{ $licenca->empresa->telefone }}
				<br/>

			</div>

			{{-- Dados da Licença --}}

			<div class="col-sm-4 invoice-col">
				<strong>Emissão:</strong> {{ implode('/', array_reverse(explode('-', $licenca->emissao))) }}
				<br/>
				<strong>Validade:</strong> {{ implode('/', array_reverse(explode('-', $licenca->validade))) }}
				<br/>
				<strong>Status:</strong>
					
					@if($licenca->validade < date('Y-m-d'))

						{{-- Caso a validade seja menor do que a data atual, Vencida, à menos --}}
						{{-- que tenha sido renovada --}}

						@if($licenca->renovada)

							<span class="label bg-blue">Renovada</span>

						@else
							
							<span class="label bg-red">Vencida</span>

						@endif

					@elseif($licenca->validade >= date('Y-m-d') && $licenca->validade <= date('Y-m-d', strtotime('+6 months')))

						{{-- Caso a Validade seja maior do que a data atual e menor do que a  --}}
						{{-- data máxima permitida, À Vencer --}}

						@if($licenca->renovada)

							<span class="label bg-blue">Renovada</span>

						@else

							<span class="label bg-yellow">À Vencer</span>

						@endif

					@else

						{{-- Caso contrário, a validade está OK --}}

						<span class="label bg-green">Ok</span>

					@endif

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