@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3>Mudar Senha</h3>
				</div>

				{{-- Formúlário de cadastro --}}

				<form action="{{ route('users.novasenha') }}" method="POST" enctype="multipart/form-data" id="form-mudar-senha">

					{!! csrf_field() !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						<div class="form-group">
							<label for="password">Senha Atual</label>
							<input type="password" class="form-control" name="senha_atual" id="senha_atual" placeholder="Senha Atual">
						</div>

						<div class="form-group">
							<label for="password">Nova Senha</label>
							<input type="password" class="form-control" name="nova_senha" id="nova_senha" placeholder="Nova Senha">
						</div>

						<div class="form-group">
							<label for="password2">Repita a Nova Senha</label>
							<input type="password" class="form-control" name="nova_senha2" id="nova_senha2" placeholder="Repita a Nova Senha">
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