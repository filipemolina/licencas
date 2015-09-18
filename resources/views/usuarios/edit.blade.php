@extends('layouts.master')

@section('content')
		
	<div class="col-md-12">
		
		{{-- Início do Box do Formulário --}}

		<div class="box box-primary">
			
			<div class="box-header with-border">
				<h3>{{ $usuario->name }}</h3>
			</div>

			{{-- Formúlário de cadastro --}}

			<form action='{{ url("/users/$usuario->id") }}' method="POST" enctype="multipart/form-data" id="form-edit-user">

				{!! csrf_field() !!}

				{{-- Method Spoofing, já que HTML 5 não tem suporte à PUT --}}

				{!! method_field('PUT') !!}

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

					<img class="pull-right ajax-loader" src="{{ asset('img/ajax-loader.gif') }}" alt="">

				</div>

			</form>

		</div>

	</div>

@endsection