@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-success">
				
				<div class="box-header with-border">
					<h3>Alterar Foto</h3>
				</div>

				{{-- Formúlário de cadastro --}}

				<form action="{{ route('users.novafoto') }}" method="POST" enctype="multipart/form-data" id="form-mudar-foto">

					{!! csrf_field() !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						<div class="form-group">
							<label for="foto">Nova Foto</label>
							<input type="file" class="form-control" name="foto" id="foto">
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