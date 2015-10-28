<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tipo;

class TiposController extends Controller
{
    // Mensagens de erro da validação

    private $mensagens = [
        'sigla.required' => 'Preencha o campo "Sigla"',
        'descricao.required' => 'Preencha o campo "Descrição"',
        'prazo.required' => 'Preencha o campo "Prazo"'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Tipos de Licença";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        // Obter todos os tipos

        $tipos = Tipo::orderBy('id', 'desc')->paginate(10);

        return view('tipos.index', compact('padrao', 'tipos'));
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

        $padrao['secao'] = "Tipos de Licença";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        // Mostrar a view com o formulário de criação

        return view('tipos.create', compact('padrao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validar

        $this->validate($request, [
            'sigla'     => 'required',
            'descricao' => 'required',
            'prazo'     => 'required'
        ], $this->mensagens);

        // Criar um novo tipo de licença

        $tipo = new Tipo;

        $tipo->fill($request->all());

        if($tipo->save())
        {
            return json_encode([
                'erros'   => false,
                'objeto' => $tipo->toJson()
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Tipos de Licença";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        // Obter o tipo de licença desejado

        $tipo = Tipo::find($id);

        return view('tipos.edit', compact('padrao', 'tipo'));
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
        // Obter o tipo sendo editado

        $tipo = Tipo::find($id);

        // Validar os dados

        $this->validate($request, [
            'sigla' => 'required',
            'descricao' => 'required',
            'prazo' => 'required'
        ], $this->mensagens);

        // Preencher os novos dados da licenca

        $tipo->fill($request->all());

        // Gravar as mudanças no banco

        if($tipo->save())
        {
            return [
                'erros' => false,
                'objeto' => $tipo->toJson() 
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
    public function destroy(Request $request, $id)
    {
        // Obter o usuário da seção

        $usuario = Auth::user();

        if(Gate::allows('controlar-usuarios'))
        {
            // Excluir o tipo de licença

            if(Tipo::destroy($id))
                return json_encode('sucesso');
            else
                return json_encode('erro');
        }
    }
}
