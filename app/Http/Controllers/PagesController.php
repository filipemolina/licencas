<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Licenca;
use App\Empresa;
use App\User;

use Hash;
use Auth;
use Illuminate\Http\Response;

class PagesController extends Controller
{
    ///////////// Controller genérico de páginas

	protected $antecedencia = "+6 months";

    /**
    * Construtor, define o nível de autenticação das actions
    *
    * @return Response
    */
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
    * Página principal, painel de controle da aplicação
    *
    * @return Response
    */
	public function painel(Request $request)
	{
		// Variáveis padrão

		$padrao = [];

		// Texto superior da página

		$padrao['secao'] = "Painel";
		$padrao['subsecao'] = "Início";
		$padrao['url'] = $request->url();

		///////////////////////////////////////////// Lista com as cinco últimas licencas e empresas criadas

		$ultimas = [];

		$ultimas['empresas'] = Empresa::orderBy('id', 'desc')->take(5)->get();
		$ultimas['licencas'] = Licenca::orderBy('id', 'desc')->take(5)->get();

		return view('pages.painel', compact('padrao', 'qtds', 'ultimas'));
	}

    /**
    * Mostra um formulário para alteração de foto do usuário
    *
    * @return Response
    */
	public function alterarFoto(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Opções";
        $padrao['subsecao'] = "Mudar Senha";
        $padrao['url'] = $request->url();

        // Obter o usuário da seção

        $usuario = Auth::user();

        return view('pages.alterarfoto', compact('padrao', 'usuario'));
    }

    /**
    * Realiza a alteração da foto do usuário no banco de dados
    *
    * @return Response
    */
    public function novaFoto(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Opções";
        $padrao['subsecao'] = "Mudar Senha";
        $padrao['url'] = $request->url();

        // Usuário Logado

        $usuario = Auth::user();

        // Testa se uma foto foi enviada

        if($request->hasFile('foto'))
        {
            // Descobrir o mimeType do arquivo
            $mime = $request->file('foto')->getMimeType();

            // Prosseguir apenas se o arquivo for uma imagem

            if(substr($mime, 0, 5) == 'image')
            {
                // Caminho onde a foto será salva
                $caminho = public_path()."/img/usuarios";

                // Extensão do arquivo da foto
                $extensao = $request->file('foto')->getClientOriginalExtension();

                // Novo nome do arquivo
                $nome = time() . "." . $extensao;

                // Mover a foto para o novo caminho, usando o novo nome
                $request->file('foto')->move($caminho, $nome);

                // Salvar o caminho da nova foto no usuário
                $usuario->foto = "img/usuarios/" . $nome;

                $usuario->save();
            }
        }

        return view('pages.alterarfoto', compact('padrao', 'usuario'));
    }

    /**
    * Mostra um formulário para alteração de senha do usuário
    *
    * @return Response
    */
    public function mudarSenha(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Opções";
        $padrao['subsecao'] = "Mudar Senha";
        $padrao['url'] = $request->url();

        // Obter o usuário da seção

        $usuario = Auth::user();

        return view('usuarios.mudarsenha', compact('padrao', 'usuario'));
    }

    /**
    * Realiza a troca de senha do usuário no banco de dados
    *
    * @return Response
    */
    public function novaSenha(Request $request)
    {
        // Obter o usuário atual

        $usuario = Auth::user();

        // Compara a senha fornecida com a senha do usuário

        if(Hash::check($request->input('senha_atual'), $usuario->password))
        {
            // Verificar se o usuário digitou a senha corretamente nos dois campos

            if($request->input('nova_senha') == $request->input('nova_senha2'))
            {
                $nova_senha = bcrypt($request->input('nova_senha'));

                $usuario->password = $nova_senha;

                if($usuario->save())
                {
                    return [
                        'erros' => false,
                        'objeto' => $usuario->toJson() 
                    ];
                }
                else
                {
                    return response()->json([
                        'responseJson' => ["Houve um problema durante o cadastro do usuário. Tente novamente mais tarde."]
                    ], 400);
                }
            }
            else
            {
                return response()->json([
                    'responseJson' => ["Os campos 'Nova Senha' e 'Repita a nova senha' devem ser iguais."]
                ], 400);
            }
        }
        else
        {
            return response()->json([
                'responseJson' => ["A senha atual não foi digitada corretamente."]
            ], 400);
        }
    }

    /**
    * Realiza a busca geral do sistema
    *
    * @return Response
    */
    public function busca(Request $request)
    {
        // Variáveis padrão

        $padrao = [];

        $padrao['secao'] = "Busca";
        $padrao['subsecao'] = "Resumo dos Resultados";
        $padrao['url'] = $request->url();

        // Termo de pesquisa

        $termo = $request->input('termo');

        // Buscar por Empresas

        $resultados['empresas'] = Empresa::where('razao_social', 'like', "%$termo%")
                                ->take(5)
                                ->get();

        // Buscar por Licencas

        $resultados['licencas'] = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade')
                                ->where('empresas.razao_social', 'like', "%$termo%")
                                ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                ->take(5)
                                ->get();

        // Buscar por Usuários

        $resultados['usuarios'] = User::where('name', 'like', "%$termo%")
                                ->take(5)
                                ->get();

        // Decidir quais resultados serão mostrados

        $classes['empresas'] = 'hidden';
        $classes['licencas'] = 'hidden';
        $classes['usuarios'] = 'hidden';

        if(count($resultados['empresas']))
            $classes['empresas'] = '';

        if(count($resultados['licencas']))
            $classes['licencas'] = '';

        if(count($resultados['usuarios']))
            $classes['usuarios'] = '';        

        return view('pages.busca', compact('padrao', 'termo', 'resultados', 'classes'));
    }

    /**
    * Realiza a busca específica por objeto
    *
    * @return Response
    */
    public function buscaEspecifica(Request $request)
    {
        // Variáveis da pesquisa

        $termo = $request->input('termo');
        $objeto = $request->input('objeto');

        // Realizar a pesquisa de acordo com o objeto

        if($objeto == 'licencas')
        {
            $resultados = Licenca::select('licencas.id', 'empresas.razao_social', 'licencas.emissao', 'licencas.validade')
                                ->where('empresas.razao_social', 'like', "%$termo%")
                                ->join('empresas', 'licencas.empresa_id', '=', 'empresas.id')
                                ->get();
        }
        else if($objeto == 'empresas')
        {
            $resultados = Empresa::where('razao_social', 'like', "%$termo%")->get();
        }
        else if($objeto == 'usuarios')
        {
            $resultados = User::select('users.id', 'users.name', 'users.email', 'roles.title')
                                ->where('name', 'like', "%$termo%")
                                ->join('roles', 'users.role_id', '=', 'roles.id')
                                ->get();
        }

        return $resultados->toJson();

    }
}