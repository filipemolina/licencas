@extends('layouts.master')

@section('content')

	{{-- Box que irá servir de container para a tabela --}}

	<div class="col-md-12">
		
		<div class="box box-primary">

			{{-- Box Header --}}
			
			<div class="box-header with-border">
				
				<h3 class="box-title">Todos os Usuários</h3>

				{{-- Caixa de Busca --}}

				<div class="box-tools pull-right">
					
					<div class="has-feedback">
						
						<input type="text" class="form-control input-sm" placeholder="Busca de Usuários">

						<span class="glyphicon glyphicon-search form-control-feedback"></span>

					</div>

				</div>

			</div>

			{{-- Box Body --}}

			<div class="box-body no-padding">

				{{-- Barra de ferramentas --}}
				
				<div class="mailbox-controls">

					<button class="btn btn-default btn-sm checkbox-toggle">
						<i class="fa fa-square-o"></i>
					</button>

					{{-- Paginação --}}
					
					<div class="pull-right">

						<div class="btn-group">
							
							<div class="btn btn-default btn-sm">
								<i class="fa fa-chevron-left"></i>
							</div>
							
							<div class="btn btn-default btn-sm">
								<i class="fa fa-chevron-right"></i>
							</div>

						</div>

					</div>

				</div>

				<div class="table-responsive mailbox-messages">
					
					{{-- Tabela de Usuários --}}

					<table class="table table-hover table-striped">
						
						<tbody>
							
							@foreach($usuarios as $usuario)
		
								<tr>
									<td>{{ $usuario->id }}</td>
									<td>{{ $usuario->name }}</td>
									<td>{{ $usuario->email }}</td>
									<td>{{ $usuario->role->title }}</td>
									<td>
										<a href="{{ route('users.edit', ['users' => $usuario->id]) }}" class="btn btn-primary btn-sm">
											<i class="fa fa-edit"></i>
										</a>
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-principal">
											<i class="fa fa-close"></i>
										</button>
									</td>
								</tr>

							@endforeach

						</tbody>

					</table>

				</div>

			</div>

		</div>

	</div>

@endsection