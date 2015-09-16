<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;

class UsersController extends Controller
{
    // Mensagens de validação

    protected $messages = [

        // Nome

        'name.required' => 'O campo Nome é obrigatório',
        'name.min' => 'O campo Nome deve ter no mínimo 6 caracteres',
        'name.max' => 'O campo nome pode ter no máximo 255 caracteres',

        // Senha

        'password.required' => 'O campo Senha é obrigatório',
        'password2.required' => 'O campo Repita a Senha é obrigatório',
        'password.min' => 'O campo Senha deve ter no mínimo 5 caracteres',
        'same' => 'O campo Repita a Senha deve ser igual ao campo Senha',

        // E-mail

        'email' => 'Preencha o campo E-mail corretamente',
        'email.unique' => 'Este e-mail já está sendo usado por outro usuário',

        // Foto

        'image' => 'O campo Foto deve ser uma imagem no formato PNG ou JPG',

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
    public function index()
    {
        // Variáveis padrão

        $secao = "Usuários";
        $subsecao = "Listar";

        // Obter todos os usuários

        $usuarios = User::all();
        
        return view('usuarios.index', compact('usuarios', 'secao', 'subsecao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Variáveis padrão

        $secao = "Usuários";
        $subsecao = "Criar";

        // Obter todos os tipos de usuário

        $roles = Role::all();

        return view('usuarios.create', compact('roles', 'secao', 'subsecao'));
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
            'foto'      => 'image'
        ], $this->messages);
        
        // Obtém a foto do $request

        $foto = $request->file('foto');

        // Cria um novo nome e especifica o caminho da pasta onde o arquivo deve ser salvo

        $novo_nome = time().".".$foto->guessExtension();

        $caminho = "/img/usuarios/";

        // Move o arquivo para a pasta de fotos de usuário e o renomeia

        $foto = $foto->move(public_path().$caminho, $novo_nome);

        // Criar o usuário e definir os dados principais

        $user = new User;
    
        $user->name  = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->foto = $caminho . $novo_nome;

        // Definir o tipo de usuário de acordo com o input do usuário

        $role = Role::find($request->input('role'));
        $user->role()->associate($role);

        $user->save();

        echo "<pre>";
        print_r($user->toArray());
        exit;

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
    public function edit($id)
    {
        // Obter o usuário à ser editado

        $usuario = User::find($id);

        // Variáveis padrão

        $secao = "Usuários";
        $subsecao = "Editar Usuário " . $usuario->name;

        // Obter todos os tipos de usuário

        $roles = Role::all();

        return view('usuarios.edit', compact('secao', 'subsecao', 'usuario', 'roles'));
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
        //
    }
}
