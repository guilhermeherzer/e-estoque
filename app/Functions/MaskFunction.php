<?php	
	function mask($val, $mask) {
	    $maskared = '';
	    $k = 0;
	    for($i = 0; $i<=strlen($mask)-1; $i++) {
	        if($mask[$i] == '#') {
	            if(isset($val[$k]))
	                $maskared .= $val[$k++];
	        }
	        else {
	            if(isset($mask[$i]))
	                $maskared .= $mask[$i];
	        }
	    }
	    return $maskared;
	}

	function cel($value){
	    $x = mask($value, "(##) #####-####");
	    return $x;
	}

	function d($value){
		if($value):
			$x = date('d/m/Y', strtotime($value));
		else:
			$x = "";
		endif;

		return $x;
	}

	function n($value){
		$x = number_format($value, 2, ',', '.');

		return $x;
	}

	function m($value){
    	$source = array('.', ',');
    	$replace = array('', '.');
    	$valor = str_replace($source, $replace, $value); //remove os pontos e substitui a virgula pelo ponto
    	return $valor; //retorna o valor formatado para gravar no banco
	}
