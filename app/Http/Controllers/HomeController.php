<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $entradas = DB::table('entradas')
            ->select('entradas.*', DB::raw('produtos.nome AS produto'), DB::raw('fornecedores.nome AS fornecedor'))
            ->leftJoin('produtos', 'produtos.id', 'entradas.produto')
            ->leftJoin('fornecedores', 'fornecedores.id', 'entradas.fornecedor')
            ->where('entradas.status', '0')
            ->orderBy('entradas.data_solicitacao', 'desc')
            ->limit(10)
            ->get();

        $saidas = DB::table('saidas')
            ->select('saidas.*', DB::raw('produtos.nome AS produto'), DB::raw('tipos_saidas.nome AS tipo'))
            ->leftJoin('produtos', 'produtos.id', 'saidas.produto')
            ->leftJoin('tipos_saidas', 'tipos_saidas.id', 'saidas.tipo')
            ->where('saidas.status', '0')
            ->orderBy('saidas.data_saida', 'desc')
            ->limit(10)
            ->get();

        $entrada_mensal = 0;

        foreach($entradas as $e):
            if(date('m', strtotime($e->data_entrega)) == date('m')):
                $entrada_mensal += $e->valor_total;
            endif;
        endforeach;

        $saida_mensal = 0;

        foreach($saidas as $s):
            if(date('m', strtotime($s->data_saida)) == date('m')):
                $saida_mensal += $s->preco_total;
            endif;
        endforeach;

        $entrada_anual = 0;

        foreach($entradas as $e):
            if(date('y', strtotime($e->data_entrega)) == date('y')):
                $entrada_anual += $e->valor_total;
            endif;
        endforeach;

        $saida_anual = 0;

        foreach($saidas as $s):
            if(date('y', strtotime($s->data_saida)) == date('y')):
                $saida_anual += $s->preco_total;
            endif;
        endforeach;

        $lucro_mensal = $saida_mensal - $entrada_mensal;

        $lucro_anual = $saida_anual - $entrada_anual;

        //dd($saida_mensal);

        $data = array('entradas' => $entradas, 'saidas' => $saidas, 'entrada_mensal' => $entrada_mensal, 'saida_mensal' => $saida_mensal, 'saida_anual' => $saida_anual, 'lucro_mensal' => $lucro_mensal, 'lucro_anual' => $lucro_anual);

        return view('home', compact('data'));
    }
}
