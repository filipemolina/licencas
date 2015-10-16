@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3>Editar Tipo de Licença</h3>
				</div>

				{{-- Formulário de cadastro --}}

				<form action="{{ url('/tipos/'.$tipo->id) }}" method="POST" enctype="multipart/form-data" id="form-edit-tipo">

					{{-- Proteção CSRF --}}

					{!! csrf_field() !!}

					{{-- Method Spoofing, já que HTML 5 não tem suporte à PUT --}}

					{!! method_field('PUT') !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						{{-- Sigla --}}

						<div class="form-group">
							<label for="sigla">Sigla</label>
							<input type="text" class="form-control" name="sigla" id="sigla" placeholder="Sigla" value="{{ $tipo->sigla }}">
						</div>

						{{-- Descrição --}}

						<div class="form-group">
							<label for="descricao">Descrição</label>
							<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" value="{{ $tipo->descricao }}">
						</div>

						{{-- Prazo --}}

						<div class="form-group">
							<label for="prazo">Prazo (Em anos)</label>
							<input type="number" class="form-control" name="prazo" id="prazo" placeholder="Prazo em Anos" value="{{ $tipo->prazo }}">
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