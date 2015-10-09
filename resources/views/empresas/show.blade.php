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

			<div class="col-sm-4 invoice-col">

				<div class="col-md-6">
					<strong>Id:</strong>
					<br/>
					<strong>Razão Social:</strong>
					<br/>
					<strong>CNPJ:</strong>
					<br/>
					<strong>E-mail:</strong>
					<br/>
					<strong>Contato:</strong>
					<br/>
					<strong>Telefone:</strong>
					<br/>
				</div>

				<div class="col-md-6">
						
					{{ $empresa->id }}
					<br/>					
					{{ $empresa->razao_social }}
					<br/>
					{{ $empresa->cnpj }}
					<br/>
					{{ $empresa->email }}
					<br/>
					{{ $empresa->contato }}
					<br/>
					{{ $empresa->telefone }}

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
								<td>{{ implode("/", array_reverse(explode('-', $licenca->emissao))) }}</td>
								<td>{{ implode("/", array_reverse(explode('-', $licenca->validade))) }}</td>
								<td>
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
								</td>
								<td>
									<a href="{{ route('licencas.show', ['licencas' => $licenca->id]) }}" class="btn btn-success btn-sm">
										<i class="fa fa-eye"></i>
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

			<a href="" class="btn btn-danger pull-right">
				<i class="fa fa-close"></i>
				Excluir
			</a>
			
			<a href="{{ route('empresas.edit', ['empresas' => $empresa->id]) }}" class="btn btn-info pull-right">
				<i class="fa fa-edit"></i>
				Editar
			</a>

		</div>

	</section>

@endsection