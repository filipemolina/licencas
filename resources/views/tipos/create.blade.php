@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-success">
				
				<div class="box-header with-border">
					<h3>Cadastrar Tipo de Licença</h3>
				</div>

				{{-- Formulário de cadastro --}}

				<form action="{{ url('/tipos') }}" method="POST" enctype="multipart/form-data" id="form-create-tipo">

					{!! csrf_field() !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						{{-- Sigla --}}

						<div class="form-group">
							<label for="sigla">Sigla</label>
							<input type="text" class="form-control" name="sigla" id="sigla" placeholder="Sigla" value="{{ old('sigla') }}">
						</div>

						{{-- Descrição --}}

						<div class="form-group">
							<label for="descricao">Descrição</label>
							<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" value="{{ old('descricao') }}">
						</div>

						{{-- Prazo --}}

						<div class="form-group">
							<label for="prazo">Prazo (Em anos)</label>
							<input type="number" class="form-control" name="prazo" id="prazo" placeholder="Prazo em Anos" value="{{ old('prazo') }}">
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