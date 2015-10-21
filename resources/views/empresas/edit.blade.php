@extends('layouts.master')

@section('content')
		
	<div class="col-md-12">

	{{-- Formúlário de cadastro --}}

		<form action='{{ url("/empresas/$empresa->id") }}' method="POST" enctype="multipart/form-data" id="form-edit-empresa">

			{!! csrf_field() !!}

			{{-- Method Spoofing, já que HTML 5 não tem suporte à PUT --}}

			{!! method_field('PUT') !!}

			{{---------------------------------- Box - Dados da Empresa ----------------------------------}}

			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3>{{ $empresa->razao_social }}</h3>
				</div>
				
				<div class="box-body">

					<div class="form-group">
						<label for="razao_social">Razão Social</label>
						<input type="text" class="form-control" name="razao_social" id="razao_social" placeholder="Razão Social" value="{{ $empresa->razao_social }}">
					</div>

					<div class="form-group">
						<label for="nome_fantasia">Nome Fantasia</label>
						<input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" placeholder="Nome Fantasia" value="{{ $empresa->nome_fantasia }}">
					</div>

					<div class="form-group">
						
						<div class="row">
							
							<div class="col-md-6">
								<label for="cnpj">CNPJ:</label>
								<input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="CNPJ" value="{{ $empresa->cnpj }}">
							</div>

							<div class="col-md-6">
								<label for="inscricao_estadual">Inscrição Estadual</label>
								<input type="text" name="inscricao_estadual" class="form-control" id="inscricao_estadual" placeholder="Inscrição Estadual" value=" {{ $empresa->inscricao_estadual }} ">
							</div>

						</div>

					</div>

					<div class="form-group">
						<label for="logradouro_requerente">Logradouro</label>
						<input type="text" class="form-control" name="logradouro_requerente" id="logradouro_requerente" placeholder="Logradouro" value="{{ $empresa->endereco_requerente->logradouro }}">
					</div>

					<div class="form-group">

						<div class="row">
							
							<div class="col-md-3">
								<label for="bairro_requerente">Bairro</label>
								<input type="text" class="form-control" name="bairro_requerente" id="bairro_requerente" placeholder="Bairro" value="{{ $empresa->endereco_requerente->bairro }}">
							</div>

							<div class="col-md-3">
								<label for="municipio_requerente">Município</label>
								<input type="text" class="form-control" name="municipio_requerente" id="municipio_requerente" placeholder="Municipio" value="{{ $empresa->endereco_requerente->municipio }}">
							</div>

							<div class="col-md-3">
								<label for="uf_requerente">UF</label>
								<input type="text" class="form-control" name="uf_requerente" id="uf_requerente" placeholder="UF" value="{{ $empresa->endereco_requerente->uf }}">
							</div>

							<div class="col-md-3">
								<label for="cep_requerente">CEP</label>
								<input type="text" class="form-control" name="cep_requerente" id="cep_requerente" placeholder="CEP" value="{{ $empresa->endereco_requerente->cep }}">
							</div>

						</div>

					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label for="telefone_requerente">Telefone</label>
								<input type="text" class="form-control" name="telefone_requerente" id="telefone_requerente" placeholder="Telefone" value="{{ $empresa->endereco_requerente->telefone }}">
							</div>
							<div class="col-md-3">
								<label for="fax_requerente">Fax</label>
								<input type="text" class="form-control" name="fax_requerente" id="fax_requerente" placeholder="Fax" value="{{ $empresa->endereco_requerente->fax }}">
							</div>
							<div class="col-md-3">
								<label for="celular_requerente">Celular</label>
								<input type="text" class="form-control" name="celular_requerente" id="celular_requerente" placeholder="Celular" value="{{ $empresa->endereco_requerente->celular }}">
							</div>
							<div class="col-md-3">
								<label for="email_requerente">E-mail</label>
								<input type="email" class="form-control" name="email_requerente" id="email_requerente" placeholder="E-mail" value="{{ $empresa->endereco_requerente->email }}">
							</div>
						</div>
					</div>

				</div>

			</div>

			{{------------------------------- Box - Dados do Empreendimento ---------------------------}}

			<div class="box box-info">

				<div class="box-header with-border">
					<h3>Endereço do Empreendimento / Atividade</h3>
				</div>

				<div class="box-body">
					
					<div class="form-group">
						<label for="logradouro_empreendimento">Logradouro</label>
						<input type="text" class="form-control" name="logradouro_empreendimento" id="logradouro_empreendimento" placeholder="Logradouro" value="{{ $empresa->endereco_empreendimento->logradouro }}">
					</div>

					<div class="form-group">

						<div class="row">
							
							<div class="col-md-3">
								<label for="bairro_empreendimento">Bairro</label>
								<input type="text" class="form-control" name="bairro_empreendimento" id="bairro_empreendimento" placeholder="Bairro" value="{{ $empresa->endereco_empreendimento->bairro }}">
							</div>

							<div class="col-md-3">
								<label for="municipio_empreendimento">Município</label>
								<input type="text" class="form-control" name="municipio_empreendimento" id="municipio_empreendimento" placeholder="Municipio" value="{{ $empresa->endereco_empreendimento->municipio }}">
							</div>

							<div class="col-md-3">
								<label for="uf_empreendimento">UF</label>
								<input type="text" class="form-control" name="uf_empreendimento" id="uf_empreendimento" placeholder="UF" value="{{ $empresa->endereco_empreendimento->uf }}">
							</div>

							<div class="col-md-3">
								<label for="cep_empreendimento">CEP</label>
								<input type="text" class="form-control" name="cep_empreendimento" id="cep_empreendimento" placeholder="CEP" value="{{ $empresa->endereco_empreendimento->cep }}">
							</div>

						</div>

					</div>

				</div>

			</div>

			{{------------------------------- Box - Dados para Correspondência ---------------------------}}

			<div class="box box-success">
				
				<div class="box-header with-border">
					<h3>Endereço de Correspondência</h3>
				</div>

				<div class="box-body">
					
					<div class="form-group">
						<label for="logradouro_correspondencia">Logradouro</label>
						<input type="text" class="form-control" name="logradouro_correspondencia" id="logradouro_correspondencia" placeholder="Logradouro" value="{{ $empresa->endereco_correspondencia->logradouro }}">
					</div>

					<div class="form-group">

						<div class="row">
							
							<div class="col-md-3">
								<label for="bairro_correspondencia">Bairro</label>
								<input type="text" class="form-control" name="bairro_correspondencia" id="bairro_correspondencia" placeholder="Bairro" value="{{ $empresa->endereco_correspondencia->bairro }}">
							</div>

							<div class="col-md-3">
								<label for="municipio_correspondencia">Município</label>
								<input type="text" class="form-control" name="municipio_correspondencia" id="municipio_correspondencia" placeholder="Municipio" value="{{ $empresa->endereco_correspondencia->municipio }}">
							</div>

							<div class="col-md-3">
								<label for="uf_correspondencia">UF</label>
								<input type="text" class="form-control" name="uf_correspondencia" id="uf_correspondencia" placeholder="UF" value="{{ $empresa->endereco_correspondencia->uf }}">
							</div>

							<div class="col-md-3">
								<label for="cep_correspondencia">CEP</label>
								<input type="text" class="form-control" name="cep_correspondencia" id="cep_correspondencia" placeholder="CEP" value="{{ $empresa->endereco_correspondencia->cep }}">
							</div>

						</div>

					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label for="telefone_correspondencia">Telefone</label>
								<input type="text" class="form-control" name="telefone_correspondencia" id="telefone_correspondencia" placeholder="Telefone" value="{{ $empresa->endereco_correspondencia->telefone }}">
							</div>
							<div class="col-md-3">
								<label for="fax_correspondencia">Fax</label>
								<input type="text" class="form-control" name="fax_correspondencia" id="fax_correspondencia" placeholder="Fax" value="{{ $empresa->endereco_correspondencia->fax }}">
							</div>
							<div class="col-md-3">
								<label for="celular_correspondencia">Celular</label>
								<input type="text" class="form-control" name="celular_correspondencia" id="celular_correspondencia" placeholder="Celular" value="{{ $empresa->endereco_correspondencia->celular }}">
							</div>
							<div class="col-md-3">
								<label for="email_correspondencia">E-mail</label>
								<input type="email" class="form-control" name="email_correspondencia" id="email_correspondencia" placeholder="E-mail" value="{{ $empresa->endereco_correspondencia->email }}">
							</div>
						</div>
					</div>

				</div>

			</div>

			{{------------------------------- Box - Representantes Legais ---------------------------}}

			<div class="box box-warning">
				
				<div class="box-header with-border">
					<h3>Representantes Legais</h3>
				</div>

				<div class="box-body">
					
					<div class="form-group">
						<div class="row">
							
							<div class="col-md-9">
								<label for="nome_representante_1">Nome:</label>
								<input type="text" class="form-control" name="nome_representante_1" id="nome_representante_1" placeholder="Nome do Primeiro Representante" value="{{ $empresa->representante_1->nome }}">
							</div>
							<div class="col-md-3">
								<label for="cpf_rg_representante_1">CPF/RG</label>
								<input type="text" class="form-control" name="cpf_rg_representante_1" id="cpf_rg_representante_1" placeholder="CPF / RG", value="{{ $empresa->representante_1->cpf_rg }}">
							</div>

						</div>
					</div>

					<div class="form-group">

						<div class="row">

							<div class="col-md-3">
								<label for="telefone_representante_1">Telefone:</label>
								<input type="text" class="form-control" name="telefone_representante_1" id="telefone_representante_1" placeholder="Telefone" value="{{ $empresa->representante_1->telefone }}">
							</div>
							<div class="col-md-3">
								<label for="fax_representante_1">Fax:</label>
								<input type="text" class="form-control" name="fax_representante_1" id="fax_representante_1" placeholder="Fax" value="{{ $empresa->representante_1->fax }}">
							</div>
							<div class="col-md-3">
								<label for="celular_representante_1">Celular:</label>
								<input type="text" class="form-control" name="celular_representante_1" id="celular_representante_1" placeholder="Celular" value="{{ $empresa->representante_1->celular }}">
							</div>
							<div class="col-md-3">
								<label for="email_representante_1">E-mail:</label>
								<input type="text" class="form-control" name="email_representante_1" id="email_representante_1" placeholder="E-mail" value="{{ $empresa->representante_1->email }}">
							</div>

						</div>

					</div>

					<div class="form-group">
						<div class="row">
							
							<div class="col-md-9">
								<label for="nome_representante_2">Nome:</label>
								<input type="text" class="form-control" name="nome_representante_2" id="nome_representante_2" placeholder="Nome do Primeiro Representante" value="{{ $empresa->representante_2->nome }}">	
							</div>
							
							<div class="col-md-3">
								<label for="cpf_rg_representante_2">CPF/RG</label>
								<input type="text" class="form-control" name="cpf_rg_representante_2" id="cpf_rg_representante_2" placeholder="CPF / RG", value="{{ $empresa->representante_2->cpf_rg }}">
							</div>

						</div>
					</div>

					<div class="form-group">

						<div class="row">

							<div class="col-md-3">
								<label for="telefone_representante_2">Telefone:</label>
								<input type="text" class="form-control" name="telefone_representante_2" id="telefone_representante_2" placeholder="Telefone" value="{{ $empresa->representante_2->telefone }}">
							</div>
							<div class="col-md-3">
								<label for="fax_representante_2">Fax:</label>
								<input type="text" class="form-control" name="fax_representante_2" id="fax_representante_2" placeholder="Fax" value="{{ $empresa->representante_2->fax }}">
							</div>
							<div class="col-md-3">
								<label for="celular_representante_2">Celular:</label>
								<input type="text" class="form-control" name="celular_representante_2" id="celular_representante_2" placeholder="Celular" value="{{ $empresa->representante_2->celular }}">
							</div>
							<div class="col-md-3">
								<label for="email_representante_2">E-mail:</label>
								<input type="text" class="form-control" name="email_representante_2" id="email_representante_2" placeholder="E-mail" value="{{ $empresa->representante_2->email }}">
							</div>

						</div>

					</div>

				</div>

			</div>

			{{------------------------------- Box - Contato ---------------------------}}

			<div class="box box-danger">
				
				<div class="box-header with-border">
					<h3>Contato</h3>
				</div>

				<div class="box-body">
					
					<div class="form-group">
						<div class="col-md-9">
							<label for="nome_contato">Nome</label>
							<input type="text" class="form-control" name="nome_contato" id="nome_contato" placeholder="Nome" value="{{ $empresa->contato->nome }}">
						</div>
						<div class="col-md-3">
							<label for="cpf_rg_contato">CPF/RG</label>
							<input type="text" class="form-control" name="cpf_rg_contato" id="cpf_rg_contato" placeholder="CPF / RG", value="{{ $empresa->contato->cpf_rg }}">
						</div>
					</div>

					<div class="form-group">
							
						<div class="col-md-3">
							<label for="telefone_contato">Telefone:</label>
							<input type="text" class="form-control" name="telefone_contato" id="telefone_contato" placeholder="Telefone" value="{{ $empresa->contato->telefone }}">
						</div>

						<div class="col-md-3">
							<label for="fax_contato	">Fax:</label>
							<input type="text" class="form-control" name="fax_contato" id="fax_contato" placeholder="Fax" value="{{ $empresa->contato->fax }}">
						</div>

						<div class="col-md-3">
							<label for="celular_contato">Celular:</label>
							<input type="text" class="form-control" name="celular_contato" id="celular_contato" placeholder="Celular" value="{{ $empresa->contato->celular }}">
						</div>

						<div class="col-md-3">
							<label for="email_contato">E-mail:</label>
							<input type="text" class="form-control" name="email_contato" id="email_contato" placeholder="E-mail" value="{{ $empresa->contato->email }}">
						</div>

					</div>

				</div>

			</div>

			{{-- Último box contendo apenas o botão de salvar --}}

			<div class="box box-info">
				
				{{-- Footer do Formulário --}}

				<div class="box-footer">
					
					<button type="submit" class="btn btn-primary pull-right">Salvar</button>

					<img class="pull-right ajax-loader" src="{{ asset('img/ajax-loader.gif') }}" alt="">

				</div>

			</div>

		</form>

	</div>

@endsection