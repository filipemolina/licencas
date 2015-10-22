<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;

use App\Empresa;
use App\Pessoa;
use App\Endereco;

use Auth;
use Session;

class EmpresasController extends Controller
{
    // Mensagens de validação

    protected $mensagens = [
        // Dados da Empresa

        'cnpj.unique'                              => 'O CNPJ fornecido já está cadastrado no banco de dados.',
        'cnpj.required'                            => 'O campo CNPJ é obrigatório.',
        'razao_social.required'                    => 'O campo "Razão Social" é obrigatório',
        'nome_fantasia.required'                   => 'O campo "Nome Fantasia" é obrigatório',
        'inscricao_estadual.required'              => 'O campo "Inscrição Estadual" é obrigatório',
        'logradouro_requerente.required'           => 'O campo "Logradouro" é obrigatório',
        'bairro_requerente.required'               => 'O campo "Bairro" é obrigatório',
        'municipio_requerente.required'            => 'O campo "Município" é obrigatório',
        'uf_requerente.required'                   => 'O campo "UF" é obrigatório',
        'cep_requerente.required'                  => 'O campo "CEP" é obrigatório',
        'telefone_requerente.required'             => 'O campo "Telefone" é obrigatório',

        // Dados do Contato

        'nome_contato.required_with'               => 'Preencha o campo "Nome" do contato.',
        'telefone_contato.required_with'           => 'Preencha o campo "Telefone" do contato.',
        'cpf_rg_contato.required_with'             => 'Preencha o campo "CPF/RG" do contato.',

        // Dados do Empreendimento

        'logradouro_empreendimento.required_with'  => 'Preencha o campo "Logradouro" do Empreendimento.',
        'bairro_empreendimento.required_with'      => 'Preencha o campo "Bairro" do Empreendimento.',
        'municipio_empreendimento.required_with'   => 'Preencha o campo "Município" do Empreendimento.',
        'uf_empreendimento.required_with'          => 'Preencha o campo "UF" do Empreendimento.',
        'cep_empreendimento.required_with'         => 'Preencha o campo "CEP" do Empreendimento.',

        // Dados de Correspondência

        'logradouro_correspondencia.required_with' => 'Preencha o campo "Logradouro" de Correspondência.',
        'bairro_correspondencia.required_with'     => 'Preencha o campo "Bairro" de Correspondência.',
        'municipio_correspondencia.required_with'  => 'Preencha o campo "Município" de Correspondência.',
        'uf_correspondencia.required_with'         => 'Preencha o campo "UF" de Correspondência.',
        'cep_correspondencia.required_with'        => 'Preencha o campo "CEP" de Correspondência.',

        // Representantes Legais

        'nome_representante_1.required_with'     => 'Preencha o campo "Nome" do 1º Representante Legal',
        'cpf_rg_representante_1.required_with'   => 'Preencha o campo "CPF / RG" do 1º Representante Legal',
        'telefone_representante_1.required_with' => 'Preencha o campo "Telefone" do 1º Representante Legal',
        'nome_representante_2.required_with'     => 'Preencha o campo "Nome" do 2º Representante Legal',
        'cpf_rg_representante_2.required_with'   => 'Preencha o campo "CPF / RG" do 2º Representante Legal',
        'telefone_representante_2.required_with' => 'Preencha o campo "Telefone" do 2º Representante Legal',
    ];

    // Proteger com autenticação

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Empresas";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        $empresas = Empresa::paginate(10);

        return view('empresas.index', compact('empresas', 'padrao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Empresas";
        $padrao['subsecao'] = "Criar";
        $padrao['url'] = $request->url();

        return view('empresas.create', compact('padrao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validação

        $this->validate($request, [
            'cnpj'         => 'required',
            'razao_social' => 'required',
            'contato'      => 'required',
            'telefone'     => 'required'
        ], $this->mensagens);

        // Criar uma nova empresa

        $empresa = new Empresa;

        $empresa->fill($request->all());

        if($empresa->save())
        {
            return json_encode([
                'erros'   => false,
                'objeto' => $empresa->toJson()
            ]);
        }
        else
        {
            return json_encode([ 'erros' => true ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Empresas";
        $padrao['subsecao'] = "Exibir";
        $padrao['url'] = $request->url();

        // Obter a empresa

        $empresa = Empresa::with('Licencas')->find($id);

        // Testar se o ID de empresa fornecido existe no banco de dados

        if(!$empresa)
        {
            // Criar a variável de erros
            $erros = new MessageBag(['1' => 'O ID da empresa fornecido não existe.']);

            // Enviar os erros pela sessão
            Session::flash('errors', $erros);

            // Redirecionar para a lista de todas as empresas
            return redirect('/empresas');
        }

        return view('empresas.show', compact('padrao', 'empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        // Obter a empresa

        $empresa = Empresa::find($id);

        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Empresas";
        $padrao['subsecao'] = "Editar Empresa";
        $padrao['url'] = $request->url();

        return view('empresas.edit', compact('empresa', 'padrao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Obter a Empresa

        $empresa = Empresa::find($id);

        ////////////////////////////////////////////////////////////////// Validar os dados do Cadastro
        
        $this->validate($request, [

            // Dados da empresa

            'cnpj'                       => 'required|unique:empresas,cnpj,' . $id,
            'razao_social'               => 'required',
            'nome_fantasia'              =>'required',
            'inscricao_estadual'         => 'required',
            'logradouro_requerente'      => 'required',
            'bairro_requerente'          => 'required',
            'municipio_requerente'       => 'required',
            'uf_requerente'              => 'required',
            'cep_requerente'             => 'required',
            'telefone_requerente'        => 'required',

            // Dados do Contato

            'nome_contato'               => 'required_with:telefone_contato,cpf_rg_contato',
            'telefone_contato'           => 'required_with:nome_contato,cpf_rg_contato',
            'cpf_rg_contato'             => 'required_with:nome_contato,telefone_contato',

            // Dados do Empreendimento

            'logradouro_empreendimento'  => 'required_with:bairro_empreendimento,municipio_empreendimento,uf_empreendimento,cep_empreendimento',
            'bairro_empreendimento'      => 'required_with:logradouro_empreendimento,municipio_empreendimento,uf_empreendimento,cep_empreendimento',
            'municipio_empreendimento'   => 'required_with:logradouro_empreendimento,bairro_empreendimento,uf_empreendimento,cep_empreendimento',
            'uf_empreendimento'          => 'required_with:logradouro_empreendimento,municipio_empreendimento,bairro_empreendimento,cep_empreendimento',
            'cep_empreendimento'         => 'required_with:logradouro_empreendimento,municipio_empreendimento,uf_empreendimento,bairro_empreendimento',

            // Dados da Correspondência

            'logradouro_correspondencia' => 'required_with:bairro_correspondencia,municipio_correspondencia,uf_correspondencia,cep_correspondencia,telefone_correspondencia,fax_correspondencia,celular_correspondencia,email_correspondencia',
            'bairro_correspondencia'     => 'required_with:logradouro_correspondencia,municipio_correspondencia,uf_correspondencia,cep_correspondencia,telefone_correspondencia,fax_correspondencia,celular_correspondencia,email_correspondencia',
            'municipio_correspondencia'  => 'required_with:logradouro_correspondencia,bairro_correspondencia,uf_correspondencia,cep_correspondencia,telefone_correspondencia,fax_correspondencia,celular_correspondencia,email_correspondencia',
            'uf_correspondencia'         => 'required_with:logradouro_correspondencia,bairro_correspondencia,municipio_correspondencia,cep_correspondencia,telefone_correspondencia,fax_correspondencia,celular_correspondencia,email_correspondencia',
            'cep_correspondencia'        => 'required_with:logradouro_correspondencia,bairro_correspondencia,municipio_correspondencia,uf_correspondencia,telefone_correspondencia,fax_correspondencia,celular_correspondencia,email_correspondencia',

            // Representantes Legais

            'nome_representante_1'       => 'required_with:cpf_rg_representante_1,telefone_representante_1',
            'cpf_rg_representante_1'     => 'required_with:nome_representante_1,telefone_representante_1',
            'telefone_representante_1'   => 'required_with:nome_representante_1,cpf_rg_representante_1',
            'nome_representante_2'       => 'required_with:cpf_rg_representante_2,telefone_representante_2',
            'cpf_rg_representante_2'     => 'required_with:nome_representante_2,telefone_representante_2',
            'telefone_representante_2'   => 'required_with:nome_representante_2,cpf_rg_representante_2',

        ], $this->mensagens);

        // Preencher os novos dados do usuário

        $empresa->fill($request->all());

        ////////////////////////////////////////////////////////////////// Gravar dados do Contato

        $contato = Pessoa::firstOrCreate(['id' => $empresa->contato_id]);

        $contato->nome = $request->input('nome_contato');
        $contato->cpf_rg = $request->input('cpf_rg_contato');
        $contato->telefone = $request->input('telefone_contato');
        $contato->fax = $request->input('fax_contato');
        $contato->celular = $request->input('celular_contato');
        $contato->email = $request->input('email_contato');

        $contato->save();

        ////////////////////////////////////////////////////////////// Gravar os dados do Empreendimento

        if($request->has('logradouro_empreendimento'))
        {
            // Salvar os dados

            $end_emp = Endereco::firstOrCreate(['id' => $empresa->endereco_empreendimento_id]);

            $end_emp->logradouro = $request->input('logradouro_empreendimento');
            $end_emp->bairro = $request->input('bairro_empreendimento');
            $end_emp->municipio = $request->input('municipio_empreendimento');
            $end_emp->uf = $request->input('uf_empreendimento');
            $end_emp->cep = $request->input('cep_empreendimento');

            $end_emp->save();
        }

        ////////////////////////////////////////////////////////////// Gravar os dados da Correspondência

        if($request->has('logradouro_correspondencia'))
        {
            $end_cor = Endereco::firstOrCreate([ 'id' => $empresa->endereco_correspondencia_id ]);

            $end_cor->logradouro = $request->input('logradouro_correspondencia');
            $end_cor->bairro = $request->input('bairro_correspondencia');
            $end_cor->municipio = $request->input('municipio_correspondencia');
            $end_cor->uf = $request->input('uf_correspondencia');
            $end_cor->cep = $request->input('cep_correspondencia');
            $end_cor->telefone = $request->input('telefone_correspondencia', '');
            $end_cor->fax = $request->input('fax_correspondencia', '');
            $end_cor->celular = $request->input('celular_correspondencia', '');
            $end_cor->email = $request->input('email_correspondencia', '');

            $end_cor->save();
        }

        ////////////////////////////////////////////////////////////// Gravar os dados dos Representantes

        // Representante 1

        if($request->has('nome_representante_1'))
        {
            $rep_1 = Pessoa::firstOrCreate(['id' => $empresa->representante_1_id]);

            $rep_1->nome = $request->input('nome_representante_1');
            $rep_1->cpf_rg = $request->input('cpf_rg_representante_1');
            $rep_1->telefone = $request->input('telefone_representante_1', '');
            $rep_1->fax = $request->input('fax_representante_1', '');
            $rep_1->celular = $request->input('celular_representante_1', '');
            $rep_1->email = $request->input('email_representante_1', '');

            $rep_1->save();
        }

        // Representante 2

        if($request->has('nome_representante_2'))
        {
            $rep_2 = Pessoa::firstOrCreate(['id' => $empresa->representante_2_id]);

            $rep_2->nome = $request->input('nome_representante_2');
            $rep_2->cpf_rg = $request->input('cpf_rg_representante_2');
            $rep_2->telefone = $request->input('telefone_representante_2', '');
            $rep_2->fax = $request->input('fax_representante_2', '');
            $rep_2->celular = $request->input('celular_representante_2', '');
            $rep_2->email = $request->input('email_representante_2', '');

            $rep_2->save();
        }

        // Gravar as mudanças no banco

        if($empresa->save())
        {
            return [
                'erros' => false,
                'objeto' => $empresa->toJson() 
            ];
        }
        else
        {
            return [ 'erros' => true ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Usuário da Seção

        $usuario = Auth::user();

        // Testar se o usuário é administrador

        if($usuario->role->id == 1)
        {
            // Excluir a empresa

            if(Empresa::destroy($id))
                return json_encode("sucesso");
            else
                return json_encode("erro");
        }
    }

    /**
     * Realiza a busca de empresas por razão social
     *
     * @param  string  $termo
     * @return Response
     */
    public function busca(Request $request, $termo)
    {
        // Testa se o termo de busca não é vazio

        if($termo != '0')
        {
            // Lista de todas as empresas que correspondem ao termo de busca

            $empresa = Empresa::where('razao_social', "like", "%$termo%")->paginate(10);
        }
        else
        {
            $empresa = Empresa::paginate(10);
        }

        return $empresa->toJson();
    }
}
