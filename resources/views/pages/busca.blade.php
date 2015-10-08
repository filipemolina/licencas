@extends('layouts.master')

@section('content')

	<input id="termo-de-pesquisa" type="hidden" value="{{ $termo }}">

	<div class="parciais">
		
		{{-- Licenças --}}

		<div class="col-md-12 {{ $classes['licencas'] }} result-licencas">
			
			<div class="box box-info">
		
				<div class="box-header with-border">
					<h3 class="box-title">Licenças</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-responsive no-margin">
							<thead>
								<tr>
									<th>ID</th>
									<th>Empresa</th>
									<th>Validade</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								
								@foreach($resultados['licencas'] as $licenca)

									<tr>
										<td>{{ $licenca->id }}</td>
										<td>{{ $licenca->razao_social }}</td>
										<td>{{ $licenca->validade }}</td>
										<td>Ações</td>
									</tr>

								@endforeach
														
								</tbody>
						</table>
					</div>
				</div>

				
				<div class="box-footer clearfix">
					<a href="" class="btn btn-sm btn-default btn-flat pull-right btn-pesquisa" data-object="licencas">VER TODOS OS RESULTADOS PARA LICENÇAS</a>
				</div>
			</div>

		</div>

		{{-- Empresas --}}

		<div class="col-md-12 {{ $classes['empresas'] }} result-empresas">
			
			<div class="box box-success">
		
				<div class="box-header with-border">
					<h3 class="box-title">Empresas</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-responsive no-margin">
							<thead>
								<tr>
									<th>ID</th>
									<th>Razão Social</th>
									<th>Contato</th>
									<th>Telefone</th>
								</tr>
							</thead>
							<tbody>
								
								@foreach($resultados['empresas'] as $empresa)

									<tr>
										<td>{{ $empresa->id }}</td>
										<td>{{ $empresa->razao_social }}</td>
										<td>{{ $empresa->contato }}</td>
										<td>{{ $empresa->telefone }}</td>
										<td>Ações</td>
									</tr>

								@endforeach
														
								</tbody>
						</table>
					</div>
				</div>

				
				<div class="box-footer clearfix">
					<a href="" class="btn btn-sm btn-default btn-flat pull-right btn-pesquisa" data-object="empresas">VER TODOS OS RESULTADOS PARA EMPRESAS</a>
				</div>
			</div>

		</div>

		{{-- Usuários --}}

		<div class="col-md-12 {{ $classes['usuarios'] }} result-usuarios">
			
			<div class="box box-warning">
		
				<div class="box-header with-border">
					<h3 class="box-title">Usuários</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
				</div>
				
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-responsive no-margin">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Cargo</th>
								</tr>
							</thead>
							<tbody>
								
								@foreach($resultados['usuarios'] as $usuario)

									<tr>
										<td>{{ $usuario->id }}</td>
										<td>{{ $usuario->name }}</td>
										<td>{{ $usuario->email }}</td>
										<td>{{ $usuario->role->title }}</td>
										<td>Ações</td>
									</tr>

								@endforeach
														
								</tbody>
						</table>
					</div>
				</div>

				
				<div class="box-footer clearfix">
					<a href="" class="btn btn-sm btn-default btn-flat pull-right btn-pesquisa" data-object="usuarios">VER TODOS OS RESULTADOS PARA USUÁRIOS</a>
				</div>
			</div>

		</div>

	</div>

@endsection