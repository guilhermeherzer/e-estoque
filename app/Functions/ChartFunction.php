<?php

function get_ap($mes, $ano){
    $entradas = DB::table('entradas')
		->select(DB::raw('MONTH(data_entrega)'), DB::raw('SUM(valor_total) as valor_total'))
		->groupBy(DB::raw('MONTH(data_entrega)'))
		->where([[DB::raw('MONTH(data_entrega)'), $mes], [DB::raw('YEAR(data_entrega)'), $ano]])
		->first();

    $saidas = DB::table('saidas')
		->select(DB::raw('MONTH(data_saida)'), DB::raw('SUM(preco_total) as preco_total'))
		->groupBy(DB::raw('MONTH(data_saida)'))
		->where([[DB::raw('MONTH(data_saida)'), $mes], [DB::raw('YEAR(data_saida)'), $ano]])
		->first();

    if($entradas):
    	if($saidas):
			$lucro_mensal = $saidas->preco_total - $entradas->valor_total;
    	else:
			$lucro_mensal = -1 * $entradas->valor_total;
    	endif;
    else:
		$lucro_mensal = 0;
    endif;

	if($lucro_mensal):
		$valor = number_format($lucro_mensal, '2', '.', '');
	else:
		$valor = 0;
	endif;
	
	return $valor;
}