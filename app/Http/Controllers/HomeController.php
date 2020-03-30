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
            ->get();

        $saidas = DB::table('saidas')
            ->select('saidas.*', DB::raw('produtos.nome AS produto'), DB::raw('tipos_saidas.nome AS tipo'))
            ->leftJoin('produtos', 'produtos.id', 'saidas.produto')
            ->leftJoin('tipos_saidas', 'tipos_saidas.id', 'saidas.tipo')
            ->where('saidas.status', '0')
            ->orderBy('saidas.data_saida', 'desc')
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

        //Charts

        $chart = new MateriaLegalChart;
        $chart->labels(['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']);
        $chart->dataset('R$ ', 'line', 
            [get_ap(1, 2020), 
                get_ap(2, 2020), 
                get_ap(3, 2020), 
                get_ap(4, 2020), 
                get_ap(5, 2020), 
                get_ap(6, 2020), 
                get_ap(7, 2020), 
                get_ap(8, 2020), 
                get_ap(9, 2020), 
                get_ap(10, 2020), 
                get_ap(11, 2020), 
                get_ap(12, 2020)])
            ->linetension(0.2);
        $chart->options([
            'maintainAspectRatio' => false,
            'elements' => [
                'line' => [
                    'borderColor' => 'rgba(78, 115, 223, 1)',
                ],
                'point' => [
                    'borderColor' => 'rgba(78, 115, 223, 1)',
                    'backgroundColor' => 'rgba(78, 115, 223, 1)'
                ]
            ],
            'layout' => [
              'padding' => [
                'left' => 10,
                'right' => 25,
                'top' => 25,
                'bottom' => 0
              ]
            ],
            'scales' => [
                'xAxes' => [[
                    'time' => [
                        'unit' => 'date'
                    ],
                    'gridLines' => [
                        'display' => false,
                        'drawBorder' => false
                    ],
                    'ticks' => [
                        'maxTicksLimit' => 12
                    ]
                ]],
                'yAxes' => [[
                    'ticks' => [
                        'maxTicksLimit' => 7,
                        'padding' => 10,
                        // Include a dollar sign in the ticks
                        //'callback' => function(value, index, values) {
                        //  return '$' + number_format(value);
                        //}
                    ],
                    'gridLines' => [
                        'color' => "rgb(234, 236, 244)",
                        'zeroLineColor' => "rgb(234, 236, 244)",
                        'drawBorder' => false,
                        'borderDash' => [2],
                        'zeroLineBorderDash' => [2]
                    ]
                ]],
            ],
            'legend' => [
                'display' => false
            ],
            'tooltips' => [
                'pointBackgroundColor' => "rgba(78, 115, 223, 1)",
                'pointBorderColor' => "rgba(78, 115, 223, 1)",
                'backgroundColor' => "rgb(255,255,255)",
                'bodyFontColor' => "#858796",
                'titleMarginBottom' => 10,
                'titleFontColor' => '#6e707e',
                'titleFontSize' => 14,
                'borderColor' => '#dddfeb',
                'borderWidth' => 1,
                'xPadding' => 15,
                'yPadding' => 15,
                'displayColors' => false,
                'intersect' => false,
                'mode' => 'index',
                'caretPadding' => 10,
                //'callbacks': {
                //  'label': function(tooltipItem, chart) {
                //          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                //          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                //  }
                //}
            ]
        ]);

        //EndCharts

        $data = array('entradas' => $entradas, 'saidas' => $saidas, 'entrada_mensal' => $entrada_mensal, 'saida_mensal' => $saida_mensal, 'saida_anual' => $saida_anual, 'lucro_mensal' => $lucro_mensal, 'lucro_anual' => $lucro_anual, 'chart' => $chart);

        return view('home', compact('data'));
    }
}
