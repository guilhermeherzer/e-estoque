<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB; 

class SaidasController extends Controller
{
    //
    public function index(Request $request){
    	$saidas = DB::table('saidas')
    		->select('saidas.*', DB::raw('produtos.nome AS produto'), DB::raw('tipos_saidas.nome AS tipo'))
    		->leftJoin('produtos', 'produtos.id', 'saidas.produto')
    		->leftJoin('tipos_saidas', 'tipos_saidas.id', 'saidas.tipo')
    		->where('saidas.status', '0')
    		->orderBy('saidas.data_saida', 'asc')
    		->get();

    	$produtos = DB::table('produtos')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$tipos = DB::table('tipos_saidas')
    		->where('status', '0')
    		->orderBy('nome', 'asc')
    		->get();

    	$data = array('saidas' => $saidas, 'produtos' => $produtos, 'tipos' => $tipos);

    	return view('saidas', compact('data'));
    }

    public function cadastrar(Request $request){
    	$saidasData = array(
    		"produto" 				=> $request->produto,
    		"quantidade" 			=> $request->quantidade,
    		"data_saida" 			=> $request->data_saida,
    		"tipo" 					=> $request->tipo,
    		"status" 				=> 0,
    		"criado_por" 			=> Auth::user()->id,
    		"atualizado_por" 		=> Auth::user()->id,
    		"created_at" 			=> date('Y/m/d H:i:s'),
    		"updated_at" 			=> date('Y/m/d H:i:s')
    	);

    	DB::table('saidas')->insert($saidasData);

    	$request->session()->flash('mensagem', 'Saida cadastrada com sucesso!');

    	return redirect('saidas/');
    }

    public function alterar(Request $request){
    	$saidasData = array(
    		"produto" 				=> $request->produto,
    		"quantidade" 			=> $request->quantidade,
    		"data_saida" 			=> $request->data_saida,
    		"tipo" 					=> $request->tipo,
    		"atualizado_por" 		=> Auth::user()->id,
    		"updated_at" 			=> date('Y/m/d H:i:s')
    	);

    	DB::table('saidas')->where('id', $request->id)->update($saidasData);

    	$request->session()->flash('mensagem', 'Saida alterada com sucesso!');

    	return redirect('saidas/');
    }

    public function deletar(Request $request){
    	if(Hash::check($request->senha, Auth::user()->password)):
	    	$saidasData = array(
	    		"status" 			=> 1,
	    		"atualizado_por" 	=> Auth::user()->id,
	    		"updated_at" 		=> date('Y/m/d H:i:s')
	    	);

	    	DB::table('saidas')->where('id', $request->id)->update($saidasData);

			$request->session()->flash('mensagem', 'Saida excluida com sucesso!');
		else:
			$request->session()->flash('mensagem', 'O Saida não pode ser excluida, senha incorreta!');
		endif;

    	return redirect('saidas/');
    }
}
