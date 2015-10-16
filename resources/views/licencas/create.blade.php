@extends('layouts.master')

@section('content')

	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			
			{{-- Início do Box do Formulário --}}

			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3>Cadastrar Licença</h3>
				</div>

				{{-- Formúlário de cadastro --}}

				<form action="{{ url('/licencas') }}" method="POST" enctype="multipart/form-data" id="form-create-licenca">

					{!! csrf_field() !!}

					{{-- Corpo do Formulário --}}
					
					<div class="box-body">

						<div class="form-group">
							<label for="tipo_id">Tipo de Licença</label>
							<select name="tipo_id" id="tipo_id" class="form-control">
								<option value="">Escolha um Tipo de Licença</option>
								
								@foreach($tipos as $tipo)

									<option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>

								@endforeach

							</select>
						</div>

						<div class="form-group">
							<label for="empresa_id">Empresa</label>
							<select name="empresa_id" id="empresa_id" class="form-control">
								<option value="">Escolha uma Empresa</option>

								@foreach($empresas as $empresa)

									<option value="{{ $empresa->id }}">{{ $empresa->razao_social }}</option>

								@endforeach

							</select>
						</div>

						{{-- Data de Emissão --}}

						<div class="form-group">
		                    <label for="emissao">Emissão</label>
		                    <div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="emissao" id="emissao" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
		                    </div>
		                </div>

		                {{-- Número da Licença --}}

		                <div class="form-group">
		                	<label for="numero">Número da Licença</label>
		                	<input type="text" name="numero" id="numero" class="form-control" placeholder="Número da Licença"/>
		                </div>

		                {{-- Número do Processo --}}

						 <div class="form-group">
		                	<label for="n_processo">Número do Processo</label>
		                	<input type="text" name="n_processo" id="n_processo" class="form-control" placeholder="Número do Processo"/>
		                </div>

						{{-- Renovada --}}

						<div class="form-group">
							<label>
		                    	<input type="checkbox" class="minimal" name="renovada" id="renovada">
		                    	Foi Renovada?
		                    </label>
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