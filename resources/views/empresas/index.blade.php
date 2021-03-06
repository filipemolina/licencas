@extends('layouts.master')

@section('content')

	{{-- Box que irá servir de container para a tabela --}}

	<div class="col-md-12">
		
		<div class="box box-success">

			{{-- Box Header --}}
			
			<div class="box-header with-border">
				
				<h3 class="box-title">Todas as Empresas</h3>

				{{-- Caixa de Busca --}}

				<div class="box-tools pull-right">
					
					<div class="has-feedback">
						
						<input type="text" id="busca-empresa" class="form-control input-sm" placeholder="Busca de Empresas">

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
								<th>Nome Fantasia</th>
								<th>CNPJ</th>
								<th>Inscrição Estadual</th>
								<th>Ações</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach($empresas as $empresa)
		
								<tr>
									<td>{{ $empresa->id }}</td>
									<td>{{ $empresa->nome_fantasia }}</td>
									<td>{{ $empresa->cnpj }}</td>
									<td>{{ $empresa->inscricao_estadual }}</td>
									<td>
										<a href="{{ route('empresas.show', ['empresas' => $empresa->id]) }}" class="btn btn-success btn-sm">
											<i class="fa fa-eye"></i>
										</a>
										<a href="{{ route('empresas.edit', ['empresas' => $empresa->id]) }}" class="btn btn-primary btn-sm">
											<i class="fa fa-edit"></i>
										</a>
										<button type="button" class="btn btn-danger btn-sm btn-excluir-empresa" data-toggle="modal" data-target="#modal-principal" data-empresa="{{ $empresa->id }}" data-razao="{{ $empresa->razao_social }}">
											<i class="fa fa-close"></i>
										</button>
									</td>
								</tr>

							@endforeach

						</tbody>

					</table>

				</div>

				{{-- Footer --}}

				<div class="mailbox-controls footer-pagination">

					{!! $empresas->render() !!}

				</div>
	
			</div>

		</div>

	</div>

@endsection