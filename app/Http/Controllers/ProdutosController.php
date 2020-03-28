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

		$tipos = DB::table('tipos_produtos')
			->where('status', '0')
			->orderBy('nome', 'asc')
			->get();

		$marcas = DB::table('marcas_produtos')
			->where('status', '0')
			->orderBy('nome', 'asc')
			->get();

		$data = array('produtos' => $produtos, 'tipos' => $tipos, 'marcas' => $marcas);

		return view('produtos', compact('data'));
	}

	public function cadastrar(Request $request){
		request()->validate([
            'img' => 'required|image|mimes:png|max:2048',
        ]);

        $imageName = request()->img->getClientOriginalName();

		if(request()->img->move(public_path('/assets/img/produtos'), $imageName)):
			$img = 'assets/img/' . $imageName;
			$produtosData = array(
				"tipo" 				=> $request->tipo,
				"marca" 			=> $request->marca,
				"nome" 				=> $request->nome,
				"img" 				=> $img,
				"preco_loja"        => m($request->preco_loja),
				"preco_app"         => m($request->preco_app),
				"status" 			=> 0,
				"criado_por" 		=> Auth::user()->id,
				"atualizado_por" 	=> Auth::user()->id,
				"created_at" 		=> date('Y/m/d H:i:s'),
				"updated_at" 		=> date('Y/m/d H:i:s')
			);

			DB::table('produtos')->insert($produtosData);

			$request->session()->flash('mensagem', 'Produto cadastrado com sucesso!');
		else:
			$request->session()->flash('mensagem', 'Imagem não foi salva.');
		endif;

		return redirect('produtos/');
	}

	public function alterar(Request $request){
		$produtosData = array(
			"nome" 				=> $request->nome,
			"preco_loja"        => m($request->preco_loja),
			"preco_app"         => m($request->preco_app),
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

	public function cadastrar_tipo(Request $request){
		$tipoData = array(
			"nome"				=>	$request->nome,
			"status"			=>	0,
			"criado_por"		=>	Auth::user()->id,
			"atualizado_por"	=>	Auth::user()->id,
			"created_at"		=>	date('Y/m/d H:i:s'),
			"updated_at"		=>	date('Y/m/d H:i:s')
		);

		DB::table('tipos_produtos')->insert($tipoData);

		$request->session()->flash('mensagem', 'Tipo de produto cadastrado com sucesso!');

		return redirect('produtos/');
	}

	public function cadastrar_marca(Request $request){
		$marcaData = array(
			"nome"				=>	$request->nome,
			"status"			=>	0,
			"criado_por"		=>	Auth::user()->id,
			"atualizado_por"	=>	Auth::user()->id,
			"created_at"		=>	date('Y/m/d H:i:s'),
			"updated_at"		=>	date('Y/m/d H:i:s')
		);

		DB::table('marcas_produtos')->insert($marcaData);

		$request->session()->flash('mensagem', 'Marca de produto cadastrado com sucesso!');

		return redirect('produtos/');
	}
}
