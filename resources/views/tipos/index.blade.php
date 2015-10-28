@extends('layouts.master')

@section('content')

	{{-- Box que irá servir de container para a tabela --}}

	<div class="col-md-12">
		
		<div class="box box-success">

			{{-- Box Header --}}
			
			<div class="box-header with-border">
				
				<h3 class="box-title">Todas os Tipos de Licença</h3>

				{{-- Caixa de Busca --}}

				<div class="box-tools pull-right">
					
					<div class="has-feedback">
						
						<input type="text" id="busca-tipo" class="form-control input-sm" placeholder="Busca de Tipos">

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
								<th>Sigla</th>
								<th>Descrição</th>
								<th>Prazo</th>
								<th>Ações</th>
							</tr>
						</thead>
						
						<tbody>
							
							@foreach($tipos as $tipo)
		
								<tr>
									<td>{{ $tipo->id }}</td>
									<td>{{ $tipo->sigla }}</td>
									<td>{{ $tipo->descricao }}</td>
									<td>{{ $tipo->prazo }} anos</td>
									<td>
										<a href="{{ route('tipos.show', ['tipos' => $tipo->id]) }}" class="btn btn-success btn-sm">
											<i class="fa fa-eye"></i>
										</a>
										<a href="{{ route('tipos.edit', ['tipos' => $tipo->id]) }}" class="btn btn-primary btn-sm">
											<i class="fa fa-edit"></i>
										</a>
										<button type="button" class="btn btn-danger btn-sm btn-excluir-tipo" data-toggle="modal" data-target="#modal-principal" data-tipo="{{ $tipo->id }}" data-desc="{{ $tipo->descricao }}">
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

					{!! $tipos->render() !!}

				</div>
	
			</div>

		</div>

	</div>

@endsection