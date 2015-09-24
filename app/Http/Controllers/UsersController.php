<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;

use Auth;

class UsersController extends Controller
{
    /////////////////////////////////// Mensagens de validação

    protected $messages = [

        // Nome

        'name.required' => 'O campo Nome é obrigatório.',
        'name.min' => 'O campo Nome deve ter no mínimo 6 caracteres.',
        'name.max' => 'O campo nome pode ter no máximo 255 caracteres.',

        // Senha

        'password.required' => 'O campo Senha é obrigatório.',
        'password2.required' => 'O campo Repita a Senha é obrigatório.',
        'password.min' => 'O campo Senha deve ter no mínimo 5 caracteres.',
        'same' => 'O campo Repita a Senha deve ser igual ao campo Senha.',

        // E-mail

        'email' => 'Preencha o campo E-mail corretamente.',
        'email.unique' => 'Este e-mail já está sendo usado por outro usuário.',

        // Foto

        'image' => 'O campo Foto deve ser uma imagem no formato PNG ou JPG.',

        // Tipo de Usuário

        'role.required' => 'O campo Tipo de Usuário não pode ser vazio.',

        // Gerais

        'required' => 'O campo :attribute é obrigatório',
            
    ];

    // Construtor

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

        $padrao['secao'] = "Usuários";
        $padrao['subsecao'] = "Listar";
        $padrao['url'] = $request->url();

        // Obter todos os usuários

        $usuarios = User::paginate(10);
        
        return view('usuarios.index', compact('usuarios', 'padrao'));
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

        $padrao['secao'] = "Usuários";
        $padrao['subsecao'] = "Criar";
        $padrao['url'] = $request->url();

        // Obter todos os tipos de usuário

        $roles = Role::all();

        return view('usuarios.create', compact('roles', 'padrao'));
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
            'name'      => 'required|min:6|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:5',
            'password2' => 'required|same:password',
            'foto'      => 'image',
            'role'      => 'required'
        ], $this->messages);

        
        // Utiliza uma foto de usuário padrão

        $novo_nome = "avatar.png";
        $caminho = "img/";

        // Criar o usuário e definir os dados principais

        $user = new User;
    
        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->foto = $caminho . $novo_nome;

        // Definir o tipo de usuário de acordo com o input do usuário

        $role = Role::find($request->input('role'));
        $user->role()->associate($role);

        if($user->save())

            return [
                'erros' => false,
                'objeto' => $user->toJson() 
            ];

        else

            return [ 'erros' => true ];

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
        // Obter o usuário à ser editado

        $usuario = User::find($id);

        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Usuários";
        $padrao['subsecao'] = "Editar Usuário " . $usuario->name;
        $padrao['url'] = $request->url();

        // Obter todos os tipos de usuário

        $roles = Role::all();

        return view('usuarios.edit', compact('usuario', 'secao', 'padrao', 'roles'));
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
        // Obter o usuário sendo atualizado

        $usuario = User::find($id);

        // Validação

        $this->validate($request, [
            'name'      => 'required|min:6|max:255',
            'email'     => 'required|email|unique:users,email,' . $id,
            'foto'      => 'image',
            'role'      => 'required'
        ], $this->messages);

        // Caso tenha passado na validação, preencher com os dados do request

        $usuario->fill($request->all());

        $role = Role::find($request->input('role'));
        $usuario->role()->associate($role);

        // Gravar as mudanças no banco

        if($usuario->save())
        {
            return [
                'erros' => false,
                'objeto' => $usuario->toJson() 
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
        // Usuário ativo da seção

        $ativo = Auth::user();

        // Testar se esse usuário é administrador

        if($ativo->role->id == 1)
        {
            // Evitar que o usuário exlua a si mesmo

            if($ativo->id != $id)   
            {
                if(User::destroy($id))
                    return json_encode("sucesso");
                else
                    return json_encode("erro");
            }
        }
    }
}
