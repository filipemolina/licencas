<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
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

		return view('pages.painel', compact('padrao'));
	}
}