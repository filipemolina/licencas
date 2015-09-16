@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3>{{ $usuario->name }}</h3>
				</div>

				{{-- Formúlário de cadastro --}}

				<form action="{{ url('/users') }}" method="POST" enctype="multipart/form-data">

					{!! csrf_field() !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						<div class="form-group">
							<label for="name">Nome:</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Nome" 
																				value="{{ $usuario->name }}">
						</div>
						
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" 
																				value="{{ $usuario->email }}">
						</div>

						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" name="foto" id="foto">
						</div>

						<div class="form-group">
							<label for="role">Tipo de Usuário</label>
							<select name="role" id="role" class="form-control">
								
								@foreach($roles as $role)

									<option value="{{ $role->id }}" @if($role->id == $usuario->role->id) selected @endif>
										{{ $role->title }}
									</option>

								@endforeach

							</select>
						</div>


					</div>

					{{-- Footer do Formulário --}}

					<div class="box-footer">
						
						<button type="submit" class="btn btn-primary pull-right">Salvar</button>

					</div>

				</form>

			</div>

		</div>

	</div>

@endsection