<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB;

class MarcasProdutosController extends Controller
{
    //
    public function index(Request $request){
    	$marcas = DB::table('marcas_produtos')
			->where('status', '0')
			->orderBy('nome', 'asc')
			->get();

    	$data = array('marcas' => $marcas);
    	
    	return view('marcas-produtos', compact('data'));
    }
    
	public function cadastrar(Request $request){
		request()->validate([
            'img' => 'required|image|mimes:png|max:2048',
        ]);

        $imageName = request()->img->getClientOriginalName();

		if(request()->img->move(public_path('/assets/img/marcas'), $imageName)):
			$img = 'assets/img/marcas/' . $imageName;
			$marcaData = array(
				"nome"				=>	$request->nome,
				"img"				=>	$img,
				"status"			=>	0,
				"criado_por"		=>	Auth::user()->id,
				"atualizado_por"	=>	Auth::user()->id,
				"created_at"		=>	date('Y/m/d H:i:s'),
				"updated_at"		=>	date('Y/m/d H:i:s')
			);

			DB::table('marcas_produtos')->insert($marcaData);

			$request->session()->flash('mensagem', 'Marca de produto cadastrado com sucesso!');
		else:
			$request->session()->flash('mensagem', 'Imagem não foi salva.');
		endif;

		return redirect('marcas-produtos/');
	}

	public function alterar(Request $request){
		$marcaData = array(
			"nome" 				=> $request->nome,
			"atualizado_por" 	=> Auth::user()->id,
			"updated_at" 		=> date('Y/m/d H:i:s')
		);

		DB::table('marcas_produtos')->where('id', $request->id)->update($marcaData);

		$request->session()->flash('mensagem', 'Marca de Produto alterada com sucesso!');

		return redirect('marcas-produtos/');
	}

	public function deletar(Request $request){
		if(Hash::check($request->senha, Auth::user()->password)):
			$marcaData = array(
				"status" 			=> 1,
				"atualizado_por" 	=> Auth::user()->id,
				"updated_at" 		=> date('Y/m/d H:i:s')
			);

			DB::table('marcas_produtos')->where('id', $request->id)->update($marcaData);

			$request->session()->flash('mensagem', 'Marca de Produto excluida com sucesso!');
		else:
			$request->session()->flash('mensagem', 'A Marca de Produto não pode ser excluida, senha incorreta!');
		endif;

		return redirect('marcas-produtos/');
	}
}
