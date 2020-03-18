<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB; 

class FornecedoresController extends Controller
{
    //
    public function index(Request $request){
    	$fornecedores = DB::table('fornecedores')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$data = array('fornecedores' => $fornecedores);

    	return view('fornecedores', compact('data'));
    }

    public function cadastrar(Request $request){
    	$fornecedoresData = array(
    		"nome" 				=> $request->nome,
    		"representante" 	=> $request->representante,
    		"contato_1" 		=> $request->contato_1,
    		"contato_2" 		=> $request->contato_2,
    		"endereço" 			=> $request->endereço,
    		"status" 			=> 0,
    		"criado_por" 		=> Auth::user()->id,
    		"atualizado_por" 	=> Auth::user()->id,
    		"created_at" 		=> date('Y/m/d H:i:s'),
    		"updated_at" 		=> date('Y/m/d H:i:s')
    	);

    	DB::table('fornecedores')->insert($fornecedoresData);

    	$request->session()->flash('mensagem', 'Fornecedor cadastrado com sucesso!');

    	return redirect('fornecedores/');
    }

    public function alterar(Request $request){
    	$fornecedoresData = array(
    		"nome" 				=> $request->nome,
    		"representante" 	=> $request->representante,
    		"contato_1" 		=> $request->contato_1,
    		"contato_2" 		=> $request->contato_2,
    		"endereço" 			=> $request->endereço,
    		"atualizado_por" 	=> Auth::user()->id,
    		"updated_at" 		=> date('Y/m/d H:i:s')
    	);

    	DB::table('fornecedores')->where('id', $request->id)->update($fornecedoresData);

    	$request->session()->flash('mensagem', 'Fornecedor alterado com sucesso!');

    	return redirect('fornecedores/');
    }

    public function deletar(Request $request){
    	if(Hash::check($request->senha, Auth::user()->password)):
	    	$fornecedoresData = array(
	    		"status" 			=> 1,
	    		"atualizado_por" 	=> Auth::user()->id,
	    		"updated_at" 		=> date('Y/m/d H:i:s')
	    	);

	    	DB::table('fornecedores')->where('id', $request->id)->update($fornecedoresData);

			$request->session()->flash('mensagem', 'Fornecedor excluido com sucesso!');
		else:
			$request->session()->flash('mensagem', 'O Fornecedor não pode ser excluido, senha incorreta!');
		endif;

    	return redirect('fornecedores/');
    }
}
