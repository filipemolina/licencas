<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Licenca;
use App\Empresa;

class PagesController extends Controller
{
	protected $antecedencia = "+6 months";

	public function __construct()
	{
		$this->middleware('auth');
	}

	///////////// Controller genérico de páginas

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
}