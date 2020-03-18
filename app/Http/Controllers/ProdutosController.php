<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB; 

class ProdutosController extends Controller
{
    //
    public function index(Request $request){
    	$produtos = DB::table('produtos')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$data = array('produtos' => $produtos);

    	return view('produtos', compact('data'));
    }

    public function cadastrar(Request $request){
    	$produtosData = array(
    		"nome" 				=> $request->nome,
    		"status" 			=> 0,
    		"criado_por" 		=> Auth::user()->id,
    		"atualizado_por" 	=> Auth::user()->id,
    		"created_at" 		=> date('Y/m/d H:i:s'),
    		"updated_at" 		=> date('Y/m/d H:i:s')
    	);

    	DB::table('produtos')->insert($produtosData);

    	$request->session()->flash('mensagem', 'Produto cadastrado com sucesso!');

    	return redirect('produtos/');
    }

    public function alterar(Request $request){
    	$produtosData = array(
    		"nome" 				=> $request->nome,
    		"atualizado_por" 	=> Auth::user()->id,
    		"updated_at" 		=> date('Y/m/d H:i:s')
    	);

    	DB::table('produtos')->where('id', $request->id)->update($produtosData);

    	$request->session()->flash('mensagem', 'Produto alterado com sucesso!');

    	return redirect('produtos/');
    }

    public function deletar(Request $request){
    	if(Hash::check($request->senha, Auth::user()->password)):
	    	$produtosData = array(
	    		"status" 			=> 1,
	    		"atualizado_por" 	=> Auth::user()->id,
	    		"updated_at" 		=> date('Y/m/d H:i:s')
	    	);

	    	DB::table('produtos')->where('id', $request->id)->update($produtosData);

			$request->session()->flash('mensagem', 'Produto excluido com sucesso!');
		else:
			$request->session()->flash('mensagem', 'O Produto não pode ser excluido, senha incorreta!');
		endif;

    	return redirect('produtos/');
    }
}
