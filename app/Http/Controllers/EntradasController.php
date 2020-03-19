<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB; 

class EntradasController extends Controller
{
    //
    public function index(Request $request){
    	$entradas = DB::table('entradas')
    		->select('entradas.*', DB::raw('produtos.nome AS produto'), DB::raw('fornecedores.nome AS fornecedor'))
    		->leftJoin('produtos', 'produtos.id', 'entradas.produto')
    		->leftJoin('fornecedores', 'fornecedores.id', 'entradas.fornecedor')
    		->where('entradas.status', '0')
    		->orderBy('entradas.data_solicitacao', 'asc')
    		->get();

    	$produtos = DB::table('produtos')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$fornecedores = DB::table('fornecedores')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$data = array('entradas' => $entradas, 'produtos' => $produtos, 'fornecedores' => $fornecedores);

    	return view('entradas', compact('data'));
    }

    public function cadastrar(Request $request){
    	$entradasData = array(
    		"produto" 				=> $request->produto,
    		"quantidade" 			=> $request->quantidade,
    		"valor_unit" 			=> m($request->valor_unit),
    		"valor_total" 			=> m($request->valor_total),
    		"fornecedor" 			=> $request->fornecedor,
    		"data_solicitacao" 		=> $request->data_solicitacao,
    		"data_entrega" 			=> $request->data_entrega,
    		"status" 				=> 0,
    		"criado_por" 			=> Auth::user()->id,
    		"atualizado_por" 		=> Auth::user()->id,
    		"created_at" 			=> date('Y/m/d H:i:s'),
    		"updated_at" 			=> date('Y/m/d H:i:s')
    	);

    	DB::table('entradas')->insert($entradasData);

    	$request->session()->flash('mensagem', 'Entrada cadastrada com sucesso!');

    	return redirect('entradas/');
    }

    public function alterar(Request $request){
    	$entradasData = array(
    		"produto" 				=> $request->produto,
    		"quantidade" 			=> $request->quantidade,
    		"valor_unit" 			=> m($request->valor_unit),
    		"valor_total" 			=> m($request->valor_total),
    		"fornecedor" 			=> $request->fornecedor,
    		"data_solicitacao" 		=> $request->data_solicitacao,
    		"data_entrega" 			=> $request->data_entrega,
    		"atualizado_por" 		=> Auth::user()->id,
    		"updated_at" 			=> date('Y/m/d H:i:s')
    	);

    	DB::table('entradas')->where('id', $request->id)->update($entradasData);

    	$request->session()->flash('mensagem', 'Entrada alterada com sucesso!');

    	return redirect('entradas/');
    }

    public function deletar(Request $request){
    	if(Hash::check($request->senha, Auth::user()->password)):
	    	$entradasData = array(
	    		"status" 			=> 1,
	    		"atualizado_por" 	=> Auth::user()->id,
	    		"updated_at" 		=> date('Y/m/d H:i:s')
	    	);

	    	DB::table('entradas')->where('id', $request->id)->update($entradasData);

			$request->session()->flash('mensagem', 'Entrada excluida com sucesso!');
		else:
			$request->session()->flash('mensagem', 'O Entrada não pode ser excluida, senha incorreta!');
		endif;

    	return redirect('entradas/');
    }
}
