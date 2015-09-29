@extends('layouts.master')

@section('content')
		
	<div class="col-md-12">
		
		{{-- Início do Box do Formulário --}}

		<div class="box box-primary">
			
			<div class="box-header with-border">
				<h3>{{ $empresa->razao_social }}</h3>
			</div>

			{{-- Formúlário de cadastro --}}

			<form action='{{ url("/empresas/$empresa->id") }}' method="POST" enctype="multipart/form-data" id="form-edit-empresa">

				{!! csrf_field() !!}

				{{-- Method Spoofing, já que HTML 5 não tem suporte à PUT --}}

				{!! method_field('PUT') !!}

				{{-- Corpo do Formulário --}}
				
				<div class="box-body">

					<div class="form-group">
						<label for="cnpj">CNPJ:</label>
						<input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="CNPJ" 
																			value="{{ $empresa->cnpj }}">
					</div>
					
					<div class="form-group">
						<label for="razao_social">Razão Social</label>
						<input type="text" class="form-control" name="razao_social" id="razao_social" placeholder="Razão Social" value="{{ $empresa->razao_social }}">
					</div>

					<div class="form-group">
						<label for="contato">Contato</label>
						<input type="text" name="contato" class="form-control" id="contato" placeholder="Contato" value=" {{ $empresa->contato }} ">
					</div>

					<div class="form-group">
						<label for="telefone">Telefone</label>
						<input type="text" name="telefone" class="form-control" id="telefone" placeholder="Telefone" value="{{ $empresa->telefone }}">
					</div>

				</div>

				{{-- Footer do Formulário --}}

				<div class="box-footer">
					
					<button type="submit" class="btn btn-primary pull-right">Salvar</button>

					<img class="pull-right ajax-loader" src="{{ asset('img/ajax-loader.gif') }}" alt="">

				</div>

			</form>

		</div>

	</div>

@endsection