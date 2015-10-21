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

        'cnpj.unique'                      => 'O CNPJ fornecido já está cadastrado no banco de dados.',
        'cnpj.required'                  => 'O campo CNPJ é obrigatório.',
        'razao_social.required'          => 'O campo "Razão Social" é obrigatório',
        'nome_fantasia.required'         => 'O campo "Nome Fantasia" é obrigatório',
        'inscricao_estadual.required'    => 'O campo "Inscrição Estadual" é obrigatório',
        'logradouro_requerente.required' => 'O campo "Logradouro" é obrigatório',
        'bairro_requerente.required'     => 'O campo "Bairro" é obrigatório',
        'municipio_requerente.required'  => 'O campo "Município" é obrigatório',
        'uf_requerente.required'         => 'O campo "UF" é obrigatório',
        'cep_requerente.required'        => 'O campo "CEP" é obrigatório',
        'telefone_requerente.required'   => 'O campo "Telefone" é obrigatório',

        // Dados do Contato

        'nome_contato.required_with'     => 'Preencha o campo "Nome" do contato.',
        'telefone_contato.required_with' => 'Preencha o campo "Telefone" do contato.',
        'cpf_rg_contato.required_with'   => 'Preencha o campo "CPF/RG" do contato.',

        // Dados do Empreendimento

        'logradouro_empreendimento' => 'Preencha o campo "Logradouro" do Empreendimento.',
        'bairro_empreendimento' => 'Preencha o campo "Bairro" do Empreendimento.',
        'municipio_empreendimento' => 'Preencha o campo "Município" do Empreendimento.',
        'uf_empreendimento' => 'Preencha o campo "UF" do Empreendimento.',
        'cep_empreendimento' => 'Preencha o campo "CEP" do Empreendimento.',
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

        ////////////////////////////////////////////////////////////////// Validar os dados da empresa

        $this->validate($request, [
            'cnpj' => 'required|unique:empresas,cnpj,' . $id,
            'razao_social' => 'required',
            'nome_fantasia' =>'required',
            'inscricao_estadual' => 'required',
            'logradouro_requerente' => 'required',
            'bairro_requerente' => 'required',
            'municipio_requerente' => 'required',
            'uf_requerente' => 'required',
            'cep_requerente' => 'required',
            'telefone_requerente' => 'required',
        ], $this->mensagens);

        // Preencher os novos dados do usuário

        $empresa->fill($request->all());

        ////////////////////////////////////////////////////////////////// Validar os dados do Contato

        $this->validate($request, [
            'nome_contato' => 'required_with:telefone_contato,cpf_rg_contato',
            'telefone_contato' => 'required_with:nome_contato,cpf_rg_contato',
            'cpf_rg_contato' => 'required_with:nome_contato,telefone_contato',
        ], $this->mensagens);

        // Gravar os dados do contato

        $contato = Pessoa::firstOrCreate(['id' => $empresa->contato_id]);

        $contato->nome = $request->input('nome_contato');
        $contato->cpf_rg = $request->input('cpf_rg_contato');
        $contato->telefone = $request->input('telefone_contato');
        $contato->fax = $request->input('fax_contato');
        $contato->celular = $request->input('celular_contato');
        $contato->email = $request->input('email_contato');

        $contato->save();

        ////////////////////////////////////////////////////////////// Validar os dados do Empreendimento

        $this->validate($request, [
            'logradouro_empreendimento' => 'required_with:bairro_empreendimento,municipio_empreendimento,uf_empreendimento,cep_empreendimento',
            'bairro_empreendimento' => 'required_with:logradouro_empreendimento,municipio_empreendimento,uf_empreendimento,cep_empreendimento',
            'municipio_empreendimento' => 'required_with:logradouro_empreendimento,bairro_empreendimento,uf_empreendimento,cep_empreendimento',
            'uf_empreendimento' => 'required_with:logradouro_empreendimento,municipio_empreendimento,bairro_empreendimento,cep_empreendimento',
            'cep_empreendimento' => 'required_with:logradouro_empreendimento,municipio_empreendimento,uf_empreendimento,bairro_empreendimento',
        ], $this->mensagens);

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
