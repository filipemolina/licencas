@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3>Cadastrar Usuário</h3>
				</div>

				{{-- Formúlário de cadastro --}}

				<form action="{{ url('/users') }}" method="POST" enctype="multipart/form-data" id="form-create-user">

					{!! csrf_field() !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						<div class="form-group">
							<label for="name">Nome:</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Nome" value="{{ old('name') }}">
						</div>
						
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="{{ old('email') }}">
						</div>

						<div class="form-group">
							<label for="password">Senha</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Senha">
						</div>

						<div class="form-group">
							<label for="password2">Repita a Senha</label>
							<input type="password" class="form-control" name="password2" id="password2" placeholder="Repita a Senha">
						</div>

						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" name="foto" id="foto">
						</div>

						<div class="form-group">
							<label for="role">Tipo de Usuário</label>
							<select name="role" id="role" class="form-control">

								<option value=""> Escolha uma Opção </option>
								
								@foreach($roles as $role)

									<option value="{{ $role->id }}">{{ $role->title }}</option>

								@endforeach

							</select>
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