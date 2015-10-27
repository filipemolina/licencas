@extends('layouts.master')

<?php 
	
	// Formatar as datas para exibição

	$emissao = implode('/', array_reverse(explode('-', $licenca->emissao)));
	$validade = implode('/', array_reverse(explode('-', $licenca->validade)));

?>

@section('content')
		
	<div class="col-md-12">
		
		{{-- Início do Box do Formulário --}}

		<div class="box box-success">
			
			<div class="box-header with-border">
				<h3>{{ $licenca->id }}</h3>
			</div>

			{{-- Formúlário de cadastro --}}

			<form action='{{ url("/licencas/$licenca->id") }}' method="POST" enctype="multipart/form-data" id="form-edit-licenca">

				{!! csrf_field() !!}

				{{-- Method Spoofing, já que HTML 5 não tem suporte à PUT --}}

				{!! method_field('PUT') !!}

				{{-- Corpo do Formulário --}}
				
				<div class="box-body">

						{{-- Tipo de Licença --}}

						<div class="form-group">
							<label for="tipo_id">Tipo de Licença</label>
							<select name="tipo_id" id="tipo_id" class="form-control">
								<option value="">Escolha um Tipo de Licença</option>
								
								@foreach($tipos as $tipo)

									<option value="{{ $tipo->id }}" @if($licenca->tipo_id == $tipo->id) selected @endif>{{ $tipo->descricao }}</option>

								@endforeach

							</select>
						</div>

						{{-- Empresa --}}

						<div class="form-group">
							<label for="empresa_id">Empresa</label>
							<select name="empresa_id" id="empresa_id" class="form-control">
								<option value="">Escolha uma Empresa</option>

								@foreach($empresas as $empresa)

									<option value="{{ $empresa->id }}"  @if($empresa->id == $licenca->empresa_id) selected @endif>{{ $empresa->razao_social }}</option>

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
								<input type="text" name="emissao" id="emissao" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="{{ $emissao }}">
		                    </div>
		                </div>

		                 {{-- Número da Licença --}}

		                <div class="form-group">
		                	<label for="numero">Número da Licença</label>
		                	<input type="text" name="numero" id="numero" class="form-control" placeholder="Número da Licença" value="{{ $licenca->numero }}"/>
		                </div>

		                {{-- Número do Processo --}}

		                <div class="form-group">
		                	<label for="n_processo">Número do Processo</label>
		                	<input type="text" name="n_processo" id="n_processo" class="form-control" placeholder="Número do Processo" value="{{ $licenca->n_processo }}"/>
		                </div>

						{{-- Renovada --}}

						<div class="form-group">
							<label>
		                    	<input type="checkbox" class="minimal" name="renovada" id="renovada" @if($licenca->renovada) checked @endif>
		                    	Foi Renovada?
		                    </label>
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