<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use App\Licenca;
use App\Empresa;

class LicencasController extends Controller
{
    // Mensagens de erro de validação

    protected $mensagens = [
        'emissao.required'   => 'O campo "Emissão" é obrigatório.',
        'validade.required'   => 'O campo "Validade" é obritagótio.',
        'empresa_id.required' => 'O campo "Empresa" é obrigatório.'
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

        $licencas = Licenca::paginate(10);

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

        return view('licencas.create', compact('empresas', 'padrao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Tratar os dados da $request

        $renovada = '';

        if($request->has('renovada'))
            $renovada = $request->input('renovada');

        $request->replace([
            '_token' => $request->input('_token'),
            'emissao' => implode('-', array_reverse(explode('/', $request->input('emissao')))),
            'validade' => implode('-', array_reverse(explode('/', $request->input('validade')))),
            'empresa_id' => $request->input('empresa_id'),
            'renovada' => $renovada
        ]);

        // Validar os dados

        $this->validate($request, [
            'emissao' => 'required',
            'validade' => 'required',
            'empresa_id' => 'required',
        ], $this->mensagens);

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

        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Licenças";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        // Lista de empresas

        $empresas = Empresa::all();

        return view('licencas.edit', compact('licenca', 'padrao', 'empresas'));
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
        // Tratar os dados da $request

        $renovada = '';

        if($request->has('renovada'))
            $renovada = $request->input('renovada');

        $request->replace([
            '_token' => $request->input('_token'),
            '_method' => $request->input('_method'),
            'emissao' => implode('-', array_reverse(explode('/', $request->input('emissao')))),
            'validade' => implode('-', array_reverse(explode('/', $request->input('validade')))),
            'empresa_id' => $request->input('empresa_id'),
            'renovada' => $renovada
        ]);

        // Validar os dados

        $this->validate($request, [
            'emissao' => 'required',
            'validade' => 'required',
            'empresa_id' => 'required',
        ], $this->mensagens);

        // Atualizar a licenca

        $licenca = Licenca::find($id);

        $licenca->fill($request->all());

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

        $licencas = Licenca::where('validade', '<=', date('Y-m-d'))->paginate(10);

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

        $licencas = Licenca::where('validade', '<=', $data_maxima)->paginate(10);

        return view('licencas.index', compact('padrao', 'licencas'));
    }
}
