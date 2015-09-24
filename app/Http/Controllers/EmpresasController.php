<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Empresa;

use Auth;

class EmpresasController extends Controller
{
    // Mensagens de validação

    protected $mensagens = [
        'cnpj.required' => 'O campo CNPJ é obrigatório.',
        'razao_social.required' => 'O campo Razão Social é obrigatório.',
        'contato.required' => 'O campo Contato é obrigatório.',
        'telefone.required' => 'O campo Telefone é obrigatório'
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
    public function show($id)
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
        //
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
        //
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
}
