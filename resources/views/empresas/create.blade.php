@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3>Cadastrar Empresa</h3>
				</div>

				{{-- Formúlário de cadastro --}}

				<form action="{{ url('/empresas') }}" method="POST" enctype="multipart/form-data" id="form-create-empresa">

					{!! csrf_field() !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						{{-- CNPJ --}}

						<div class="form-group">
							<label for="name">CNPJ</label>
							<input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="CNPJ" value="{{ old('cnpj') }}">
						</div>

						{{-- Razão Social --}}

						<div class="form-group">
							<label for="name">Razão Social</label>
							<input type="text" class="form-control" name="razao_social" id="razao_social" placeholder="Razão Social" value="{{ old('razao_social') }}">
						</div>

						{{-- Contato --}}

						<div class="form-group">
							<label for="name">Contato</label>
							<input type="text" class="form-control" name="contato" id="contato" placeholder="Contato" value="{{ old('contato') }}">
						</div>

						{{-- Telefone --}}

						<div class="form-group">
							<label for="name">Telefone</label>
							<input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
						</div>

					</div>

					{{-- Footer do Formulário --}}

					<div class="box-footer">
						
						<button type="submit" class="btn btn-primary pull-right">Enviar</button>

						<img class="pull-right ajax-loader" src="{{ asset('img/ajax-loader.gif') }}" alt="">

					</div>

				</form>

			</div>

		</div>

	</div>

@endsection