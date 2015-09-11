<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $usuarios = User::all();

        echo '<pre>';
        echo "<h1>Usuários</h1><br/>";
        print_r($usuarios);
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Temporário

        $nomes = [ 'João', 'Carlos', 'Alberto', 'Leonardo', 'Donatelo', 'Miquelângelo', 'Rafael', 'Adriano', 'Otávio' ];

        $i = 0;

        foreach($nomes as $nome)
        {
            // Instanciar o usuário
            $usuario = new User;

            // Preencher os dados básicos
            $usuario->name = $nome;
            $usuario->email = $nome . "@gmail.com";
            $usuario->password = "123abc";

            // Gravar no DB

            $usuario->save();

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
