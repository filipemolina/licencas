@extends('layouts.master')

@section('content')
	
	{{-- Caixas informativas do topo da página --}}

	<div class="col-md-3 col-md-offset-1">

		{{-- Licenças Renovadas --}}

		<div class="small-box bg-green">
			<div class="inner">
				<h3>{{ $qtds['renovadas'] }}</h3>
				<p>Licenças Renovadas</p>
			</div>
			<div class="icon">
				<i class="ion ion-checkmark-round"></i>
			</div>
			<a href="{{ route('licencas.index') }}" class="small-box-footer">Ver todas <i class="fa fa-arrow-circle-right"></i></a>
		</div>

	</div>

	<div class="col-md-3">

		{{-- Licenças À Vencer --}}

		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>{{ $qtds['avencer'] }}</h3>
				<p>Licenças à Vencer</p>
			</div>
			<div class="icon">
				<i class="ion ion-alert"></i>
			</div>
			<a href="{{ route('licencas.avencer') }}" class="small-box-footer">Ver todas <i class="fa fa-arrow-circle-right"></i></a>
		</div>

	</div>

	<div class="col-md-3">

		{{-- Licenças À Vencer --}}

		<div class="small-box bg-red">
			<div class="inner">
				<h3>{{ $qtds['vencidas'] }}</h3>
				<p>Licenças Vencidas</p>
			</div>
			<div class="icon">
				<i class="ion ion-close-round"></i>
			</div>
			<a href="{{ route('licencas.vencidas') }}" class="small-box-footer">Ver todas <i class="fa fa-arrow-circle-right"></i></a>
		</div>

	</div>

	{{------------------------------- Últimas licenças cadastradas --------------------------------------}}

	<div class="col-md-8">
		
		<div class="box box-success">
		
			{{-- Box-Header --}}

			<div class="box-header with-border">
				<h3 class="box-title">Últimas Licenças</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>

			{{-- Box-Body --}}

			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-responsive no-margin">
						<thead>
							<tr>
								<th>ID</th>
								<th>Empresa</th>
								<th>Validade</th>
							</tr>
						</thead>
						<tbody>

							@foreach($ultimas['licencas'] as $licenca)
								<tr>
									<td>{{ $licenca->id }}</td>
									<td>{{ $licenca->empresa->razao_social }}</td>
									<td>{{ implode('/', array_reverse(explode('-', $licenca->validade))) }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			{{-- Box-Footer --}}

			<div class="box-footer clearfix">
				<a href="{{ route('licencas.index') }}" class="btn btn-sm btn-default btn-flat pull-right">Ver últimas licenças</a>
			</div>
		</div>
	</div>

	{{------------------------------------ Últimas Empresas ------------------------------------}}

	<div class="col-md-4">
		
		<div class="box box-success">
		
		{{-- Box-Header --}}

			<div class="box-header with-border">
				<h3 class="box-title">Últimas Empresas</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>

			{{-- Box-Body --}}

			<div class="box-body">
				
				<div class="table-responsive">
					
					<table class="table table-striped">
						
						<thead>
							<tr>
								<th>ID</th>
								<th>Razão Social</th>
							</tr>
						</thead>

						<tbody>

							@foreach($ultimas['empresas'] as $empresa)
								<tr>
									<td>{{ $empresa->id }}</td>
									<td>{{ $empresa->razao_social }}</td>
								</tr>
							@endforeach

						</tbody>

					</table>

				</div>

			</div>

			{{-- Box-Footer --}}

			<div class="box-footer text-center">
				<a href="{{ route('empresas.index') }}" class="uppercase">Ver todas as Empresas</a>
			</div>

		</div>

	</div>

@endsection