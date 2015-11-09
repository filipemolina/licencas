<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use Session;
use PDF;

use App\Licenca;
use App\Empresa;
use App\Tipo;

class LicencasController extends Controller
{
    // Mensagens de erro de validação

    protected $mensagens = [
        'emissao.required'    => 'O campo "Emissão" é obrigatório.',
        'empresa_id.required' => 'O campo "Empresa" é obrigatório.',
        'tipo_id.required'    => 'O campo "Tipo de Licença" é obrigatório.',
    ];

    // Antecedência com a qual o sistema alertará sobre o vencimento de uma licença
    // Formato de string aceita pela função PHP date()

    protected $antecedencia = "+6 months";

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

        $padrao['secao'] = "Licenças";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        $licencas = Licenca::orderBy('id', 'desc')->paginate(10);

        return view('licencas.index', compact('licencas', 'padrao'));
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

        $padrao['secao'] = "Licenças";
        $padrao['subsecao'] = "Criar";
        $padrao['url'] = $request->url();

        // Obter uma lista de empresas

        $empresas = Empresa::all();

        // Obter uma lista de tipos de licença

        $tipos = Tipo::all();

        return view('licencas.create', compact('empresas', 'tipos', 'padrao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validar os dados

        $this->validate($request, [
            'emissao' => 'required',
            'empresa_id' => 'required',
            'tipo_id' => 'required'
        ], $this->mensagens);

        // Tratar os dados da $request

        $renovada = '';

        if($request->has('renovada'))
            $renovada = $request->input('renovada');

        // Tratar a data de emissão

        $emissao = implode('-', array_reverse(explode('/', $request->input('emissao'))));

        // Obter o tipo de licença escolhido pelo usuário

        $tipo = Tipo::find($request->input('tipo_id'));

        // Calcular a validade baseada no prazo do tipo de licença

        $validade = date('Y-m-d', strtotime("+$tipo->prazo years", strtotime($emissao)));

        $request->replace([
            '_token' => $request->input('_token'),
            'emissao' => $emissao,
            'validade' => $validade,
            'empresa_id' => $request->input('empresa_id'),
            'tipo_id' => $request->input('tipo_id'),
            'numero' => $request->input('numero'),
            'n_processo' => $request->input('n_processo'),
            'renovada' => $renovada
        ]);

        // Criar uma nova licença

        $licenca = new Licenca;

        $licenca->fill($request->all());

        // Identificar se a licença já foi renovada

        if($renovada == 'on')
            $licenca->renovada = true;
        else
            $licenca->renovada = false;

        // Salvar a licença no banco de dados

        if($licenca->save())
        {
            return [
                'erros' => false,
                'objeto' => $licenca->toJson() 
            ];
        }
        else
        {
            return [ 'erros' => true ];
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

        $padrao['secao'] = "Licenças";
        $padrao['subsecao'] = "Exibir";
        $padrao['url'] = $request->url();   

        // Obter a licença à ser exibida

        $licenca = Licenca::with('Empresa')->find($id);

        // Verificar se o id de licença fornecido existe no banco de dados

        if(!$licenca)
        {
            // Criar a variável de erros
            $erros = new MessageBag([ '1' => 'O ID da licença fornecido não existe!']);

            // Enviar os erros pela sessão
            Session::flash('errors', $erros);

            // Redirecionar para a lista de todas as licenças
            return redirect('/licencas');
        }

        return view('licencas.show', compact('padrao', 'licenca'));
    }

    public function imprimir(Request $request)
    {
        return PDF::loadFile('http://www.github.com')->stream('github.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        // Obter a licença

        $licenca = Licenca::find($id);

        // Obter todos os tipos de licença

        $tipos = Tipo::all();

        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Licenças";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        // Lista de empresas

        $empresas = Empresa::all();

        return view('licencas.edit', compact('licenca', 'tipos', 'padrao', 'empresas'));
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
        // Validar os dados

        $this->validate($request, [
            'emissao' => 'required',
            'empresa_id' => 'required',
            'tipo_id' => 'required',
        ], $this->mensagens);

        // Tratar os dados da $request

        $renovada = '';

        if($request->has('renovada'))
            $renovada = $request->input('renovada');

        // Atualizar a licenca

        $licenca = Licenca::find($id);

        // Obter o tipo de licença escolhido pelo usuário

        $tipo = Tipo::find($request->input('tipo_id'));

        // Tratar a data de emissão

        $emissao = implode('-', array_reverse(explode('/', $request->input('emissao'))));

        // Calcular a validade baseada no prazo do tipo de licença

        $validade = date('Y-m-d', strtotime("+$tipo->prazo year", strtotime($emissao)));

        $request->replace([
            '_token' => $request->input('_token'),
            '_method' => $request->input('_method'),
            'emissao' => $emissao,
            'empresa_id' => $request->input('empresa_id'),
            'renovada' => $renovada,
        ]);

        $licenca->fill($request->all());

        $licenca->validade = $validade;

        // Alterar o status de renovada da licença

        if($renovada == 'on')
            $licenca->renovada = true;
        else
            $licenca->renovada = false;

        // Salvar a licença no banco de dados

        if($licenca->save())
        {
            return [
                'erros' => false,
                'objeto' => $licenca->toJson() 
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
        // Usuário da seção

        $usuario = Auth::user();

        // Testar se o usuário é administrador

        if($usuario->role->id == 1)
        {
            // Excluir Licença

            if(Licenca::destroy($id))
                return json_encode("sucesso");
            else
                return json_encode("erro");
        }
    }

    /**
     * Mostra uma lista apenas com as licenças que já estão vencidas
     *
     * @return Response
     */
    public function vencidas(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Licenças";
        $padrao['subsecao'] = "Vencidas";
        $padrao['url'] = $request->url();

        // Lista de licenças vencidas

        $licencas = Licenca::where('validade', '<=', date('Y-m-d'))
                            ->where('renovada', '=', 0)
                            ->orderBy('id', 'desc')
                            ->paginate(10);

        return view('licencas.index', compact('padrao', 'licencas'));
    }

     /**
     * Mostra uma lista apenas com as licenças que já entraram no prazo de vencimento
     *
     * @return Response
     */
    public function avencer(Request $request)
    {
        // Data máxima de vencimento para que o sistema inclua uma licença na tela de
        // "Licenças à Vencer"

        $data_maxima = date('Y-m-d', strtotime($this->antecedencia));

        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Licenças";
        $padrao['subsecao'] = "À Vencer";
        $padrao['url'] = $request->url();

        // Lista de licenças à vencer

        $licencas = Licenca::where('validade', '<=', $data_maxima)
                            ->where('validade', '>=', date('Y-m-d'))
                            ->where('renovada', '=', 0)
                            ->orderBy('id', 'desc')
                            ->paginate(10);

        return view('licencas.index', compact('padrao', 'licencas'));
    }

     /**
     * Realiza a busca de empresas por razão social
     *
     * @param  string  $termo
     * @return Response
     */
    public function busca(Request $request, $termo, $tipo)
    {
        // Testa se o termo de busca não é vazio

        if($termo != '0')
        {
            // Definir o tipo de resultado baseado no tipo de busca

            if($tipo == 'avencer')
            {
                $data_maxima = date('Y-m-d', strtotime($this->antecedencia));

                $licencas = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade', 'licencas.renovada')
                                    ->where('empresas.razao_social', 'like', "%$termo%")
                                    ->where('validade', '<=', $data_maxima)
                                    ->where('validade', '>=', date('Y-m-d'))
                                    ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
            }
            else if($tipo == 'vencidas')
            {
                $licencas = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade', 'licencas.renovada')
                                    ->where('empresas.razao_social', 'like', "%$termo%")
                                    ->where('validade', '<', date('Y-m-d'))
                                    ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
            }
            else
            {
                // Realizar um Join das tabelas "Empresas" e "Licenças" e retornar apenas as linhas onde a razão
                // social da empresa corresponde ao termo de pesquisa.

                $licencas = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade', 'licencas.renovada')
                                    ->where('empresas.razao_social', 'like', "%$termo%")
                                    ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
            }
        }
        else
        {
            // Retornar todas as licenças de acordo com o tipo

            if($tipo == 'avencer')
            {
                $data_maxima = date('Y-m-d', strtotime($this->antecedencia));

                $licencas = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade', 'licencas.renovada')
                                    ->where('validade', '<=', $data_maxima)
                                    ->where('validade', '>=', date('Y-m-d'))
                                    ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
            }
            else if($tipo == 'vencidas')
            {
                $licencas = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade', 'licencas.renovada')
                                    ->where('validade', '<', date('Y-m-d'))
                                    ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);   
            }
            else
            {
                $licencas = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade', 'licencas.renovada')
                                    ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
            }
        }

        return $licencas->toJson();
    }
}
