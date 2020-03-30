<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB;

class TiposProdutosController extends Controller
{
    //
    public function index(Request $request){
    	$tipos = DB::table('tipos_produtos')
			->where('status', '0')
			->orderBy('nome', 'asc')
			->get();

    	$data = array('tipos' => $tipos);

    	return view('tipos-produtos', compact('data'));
    }

	public function cadastrar(Request $request){
		$tipoData = array(
			"nome"				=>	$request->nome,
			"status"			=>	0,
			"criado_por"		=>	Auth::user()->id,
			"atualizado_por"	=>	Auth::user()->id,
			"created_at"		=>	date('Y/m/d H:i:s'),
			"updated_at"		=>	date('Y/m/d H:i:s')
		);

		DB::table('tipos_produtos')->insert($tipoData);

		$request->session()->flash('mensagem', 'Categoria de produto cadastrada com sucesso!');

		return redirect('tipos-produtos/');
	}

	public function alterar(Request $request){
		$tipoData = array(
			"nome" 				=> $request->nome,
			"atualizado_por" 	=> Auth::user()->id,
			"updated_at" 		=> date('Y/m/d H:i:s')
		);

		DB::table('tipos_produtos')->where('id', $request->id)->update($tipoData);

		$request->session()->flash('mensagem', 'Categoria de Produto alterada com sucesso!');

		return redirect('tipos-produtos/');
	}

	public function deletar(Request $request){
		if(Hash::check($request->senha, Auth::user()->password)):
			$tipoData = array(
				"status" 			=> 1,
				"atualizado_por" 	=> Auth::user()->id,
				"updated_at" 		=> date('Y/m/d H:i:s')
			);

			DB::table('tipos_produtos')->where('id', $request->id)->update($tipoData);

			$request->session()->flash('mensagem', 'Categoria de Produto excluida com sucesso!');
		else:
			$request->session()->flash('mensagem', 'A Categoria de Produto não pode ser excluida, senha incorreta!');
		endif;

		return redirect('tipos-produtos/');
	}
}
