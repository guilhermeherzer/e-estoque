<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class EstoqueController extends Controller
{
    //
    public function index(Request $request){
    	$produtos = DB::table('produtos')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$estoque = array();

    	foreach($produtos as $p):

		    	$entradas = DB::table('entradas')
		    		->select(DB::raw('SUM(quantidade) as quantidade'))
		    		->groupBy('produto')
		    		->where([['status', 0], ['produto', $p->id]])
		    		->first();


		    	$saidas = DB::table('saidas')
		    		->select(DB::raw('SUM(quantidade) as quantidade'))
		    		->groupBy('produto')
		    		->where([['status', 0], ['produto', $p->id]])
		    		->first();

		    	if($entradas):
		    		$entradas = $entradas->quantidade;
		    	endif;

		    	if($saidas):
		    		$saidas = $saidas->quantidade;
		    	endif;
    				
    			$estoque[] = ['id' => $p->id, 'produto' => $p->nome, 'entradas' => $entradas, 'saidas' => $saidas];
    	endforeach;

    	$fornecedores = DB::table('fornecedores')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$data = array('estoque' => $estoque, 'produtos' => $produtos, 'fornecedores' => $fornecedores);

    	return view('estoque', compact('data'));
    }
}
