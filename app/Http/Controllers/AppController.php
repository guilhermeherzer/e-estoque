<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class AppController extends Controller
{
    //
	public function index(Request $request){
		$tipos = DB::table('tipos_produtos')
			->where('status', 0)
			->orderBy('nome', 'asc')
			->get();
		$data = array('tipos' => $tipos);

		return view('app/index', compact('data'));
	}
    
	public function categoria(Request $request){
		$produtos = DB::table('produtos')
			->select('produtos.*', DB::raw('marcas_produtos.nome AS marca'))
			->leftJoin('tipos_produtos', 'tipos_produtos.id', 'produtos.tipo')
			->leftJoin('marcas_produtos', 'marcas_produtos.id', 'produtos.marca')
			->where('produtos.status', 0)
			->orderBy('produtos.nome', 'asc')
			->where('tipos_produtos.nome', $request->categoria)
			->get();

		$marcas = array();

		foreach($produtos as $p):
			$marca = DB::table('marcas_produtos')
				->where('nome', $p->marca)
				->first();

			$marcas[] = $marca->nome;
		endforeach;

		$marcas = array_unique($marcas);

		$produtoData = array();


		foreach($marcas as $m):
			$produtoData[] = ['marca' => $m, 'produtos' => $produtos->where('marca', $m)];
		endforeach;

		$data = array('produtoData' => $produtoData);

		return view('app/categoria', compact('data'));
	}
}
