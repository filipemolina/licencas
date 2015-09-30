@extends('layouts.master')

@section('content')

	{{-- Box que irá servir de container para a tabela --}}

	<div class="col-md-12">
		
		<div class="box box-primary">

			{{-- Box Header --}}
			
			<div class="box-header with-border">
				
				<h3 class="box-title">{{ $padrao['subsecao'] }}</h3>

				{{-- Caixa de Busca --}}

				<div class="box-tools pull-right">
					
					<div class="has-feedback">
						
						<input type="text" class="form-control input-sm" placeholder="Busca de Licenças">

						<span class="glyphicon glyphicon-search form-control-feedback"></span>

					</div>

				</div>

			</div>

			{{-- Box Body --}}

			<div class="box-body no-padding">

				{{-- Barra de ferramentas --}}
				
				<div class="mailbox-controls">

				</div>

				<div class="table-responsive mailbox-messages">
					
					{{-- Tabela de Usuários --}}

					<table class="table table-hover table-striped">

						<thead>
							<tr>
								<th>ID</th>
								<th>Empresa</th>
								<th>Emissão</th>
								<th>Validade</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach($licencas as $licenca)
		
								<tr>
									<td>{{ $licenca->id }}</td>
									<td>{{ $licenca->empresa->razao_social }}</td>
									<td>{{ implode('/', array_reverse(explode("-", $licenca->emissao))) }}</td>
									<td>{{ implode('/', array_reverse(explode("-", $licenca->validade))) }}</td>
									<td>
										<a href="{{ route('licencas.edit', ['licencas' => $licenca->id]) }}" class="btn btn-primary btn-sm">
											<i class="fa fa-edit"></i>
										</a>
										<button type="button" class="btn btn-danger btn-sm btn-excluir-licenca" data-toggle="modal" data-target="#modal-principal" data-licenca="{{ $licenca->id }}" data-titulo="{{ $licenca->id }}">
											<i class="fa fa-close"></i>
										</button>
									</td>
								</tr>

							@endforeach

						</tbody>

					</table>

				</div>

				{{-- Footer --}}

				<div class="mailbox-controls">

					{!! $licencas->render() !!}

				</div>
	
			</div>

		</div>

	</div>
	
@endsection