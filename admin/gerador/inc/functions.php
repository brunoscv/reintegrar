<?php

/**
 * @author trashboy.mine.nu
 * @copyright 2010
 */

/**
 * @function arShow(array $arr)
 * Mostra o conteudo do array, visivel para o usuario
 */
function arShow( $arr ){
    echo "<pre>";
        print_r($arr);
    echo "</pre>";
}
/**
 * @function _extra
 * funcao 
*/
function _extra( $extra ){
    
    if( is_array( $extra ) ){
        foreach($extra as $attr => $value){
            if( $attr != 'name' )
                $extra .= $attr.'="'.$value.'"';
        }        
    }

    return $extra;
}
/**
 * @function label(string $text, string $for, string/array $extra)
 * Mostra um <label>texto</label>
 */
function label($text, $for='', $extra=''){
    $extra = _extra($extra);
    return '<label for="'.$for.'" '.$extra.'>'.$text.'</label>';
}

/**
 * @function input(string $name, array $params)
 * $name string contendo o nome do input
 * $params array com os indices 'type','extra'. 'Extra' pode ser array ou string.
 */
function input($name, $params){
	$params['extra'] .= (!empty($params['value'])) ? ' value = "'.$params['value'].'"' : "";
    $value = $params['value'];
    $extra = _extra($params['extra']);
    return '<input name="'.$name.'" type="'.$params['type'].'" '.$extra.' />';
}

/**
 * @function text(string $name, array $extra)
 * $name string contendo o nome do input
 * $extra pode ser array ou string.
 */
function text( $name, $value = '', $extra = '' ){
    $params = array(
                'type' => 'text',
                'extra' => $extra,
                'value' => $value
            );
    return input($name,$params);
}

function hidden( $name, $value='',$extra = '' ){
    $params = array(
                'type' => 'hidden',
                'extra' => $extra,
                'value' => $value
            );
    return input($name,$params);
}

function password( $name, $value='',$extra = '' ){
    $params = array(
                'type' => 'password',
                'extra' => $extra,
                'value' => $value
            );
    return input($name,$params);
}

function checkbox( $name, $value='',$extra = '' ){
    $params = array(
                'type' => 'checkbox',
                'extra' => $extra,
                'value' => $value
            );
    return input($name,$params);
}

function radio( $name, $value='',$extra = '' ){
    $params = array(
                'type' => 'radio',
                'extra' => $extra,
                'value' => $value
            );
    return input($name,$params);
}
/**
 * @function radiolist(string $name, array $options, string $checked)
 * Criar uma lista de radio baseado em um array(chave/valor) $options
 * $checked deve deve conter o valor a ser selecionado
 */
function radioList( $name, $options, $checked = '' ){
    $i=0;
    if( is_array($options) ){
        foreach( $options as $value => $text){
            $id = $name.$i;
            if( $value == $checked )
                $list .= checkbox($value, 'id="'.$id.'"','checked=checked').label($text,$id);
            else
                $list .= checkbox($value, 'id="'.$id.'"').label($text,$id);
            $i++;
        }
    }
    return false;
}

/**
 * @function radiolist(string $name, array $options, array $checkeds)
 * Criar uma lista de radio baseado em um array(chave/valor) $options
 * $checked deve deve conter o valor a ser selecionado
 */
function checkboxList( $name, $options, $checkeds = array() ){
    $i=0;
    if( is_array($options) ){
        foreach( $options as $value => $text){
            $id = $name.$i;
            if( in_array($value,$checkeds) )
                $list .= checkbox($value, 'id="'.$id.'"','checked=checked').label($text,$id);
            else
                $list .= checkbox($value, 'id="'.$id.'"').label($text,$id);
            $i++;
        }
    }
    return false;
}
/**
 * @function textarea(string $name, string $value, array $params)
 * $params
 */
function textarea( $name, $value='', $params = array() ){
    
    if( isset($params['cols']) )
        $params['cols'] = '70';
    if( isset($params['cols']) )
        $params['rows'] = '6';
        
    $extra = _extra($params);
    return '<textarea name="'.$name.'" '.$extra.' >'.$value.'</textarea>'; 
}
/**
 * @function makeSelect(string $name, array $params)
 * $name string contendo o nome do select
 * $params array com os indices 'options','extra','selected'. 'Extra' pode ser array ou string.
 */
function select( $name, $params ){
    $extra = _extra($params['extra']);
    return '<select name="'.$name.'" '.$extra.' >'.makeOptions($params['options'],$params['selected']).'</select>';   
}
/**
 *
 * @function makeOptions(array $options, string $selected)
 * Array $options deve receber um array com $key e $value
 * onde $key o valor do option e $value o 
 * Cria uma lista de <option /> para o campo Select
 */
function makeOptions( $options, $selected = '' ){
    if( is_array($options) )
        foreach( $options as $key => $value ){
            if( $key == $selected )
                $string .= '<option value="'.$key.'" selected="selected">'.$value.'</option>';
            else
                $string .= '<option value="'.$key.'">'.$value.'</option>';
        }
    else
        return false;
    
    return $string;
}

function plural($string){
    $special = array(
        'par' => 'pares',
        'paz' => 'pazes',
        'canon' => 'canones',
        'lapis' => 'lapis',
        'onibus' => 'onibus',
        'virus' => 'virus',
        'cais' => 'cais',
        'xis' => 'xis',
        'mal' => 'males',
        'consul' => 'consules'
    );
    
    if( key_exists($string,$special) ){
        return $special[$string];
    }
    
    if( preg_match('/(al|el|ol|ul)$/',$string) )
        return substr($string,0,-1)."is";
        
    if( preg_match('/(il)$/',$string) )
        return substr($string,0,-1)."s";
    
    if( preg_match('/(r|s)$/',$string) )
        return $string."es";

    if( preg_match('/(m)$/',$string) )
        return $string."ns";
    
    if( preg_match('/(ens|x)$/',$string) )
        return $string;
    
    if( preg_match('/(ae|a|e|i|o|u|n)$/',$string) )
        return $string."s";
}

function camelSingular($string){
	return camelCase(singular($string));
}

function singular($string){
	$words = explode("_",$string);
	$str = "";
	for( $i = 0; $i<count($words); $i++ ){
		$string = $words[$i];
		
		if( preg_match('/(res)$/', $string ) ){
			$str .= preg_replace("/(res)$/", "r", $string );
		} elseif( preg_match('/(ses)$/', $string ) ){
			$str .= preg_replace("/(ses)$/", "s", $string );
		} elseif( preg_match('/(ns)$/', $string ) ){
			$str .= preg_replace("/(ns)$/", "m", $string );
		} elseif( preg_match('/(fis)$/', $string ) ){
			$str .= preg_replace("/(fis)$/", "fil", $string );
		} elseif( preg_match('/(s)$/', $string ) ){
			$str .= preg_replace("/(s)$/", "", $string );
		} 	
		
		$str .= " ";
	}
	return $str;
}

function camelCase($string){
	$string = str_replace("_", " ", $string);
	$words = explode(" ",$string);
	$str = $str;
	for($i=0; $i<count($words);$i++){
		if( $i == 0 ){
			$str = $words[$i];
		} else {
			$str .= ucfirst($words[$i]);
		}
	}
	return $str;
}

function tab($times){
    for($i=0; $i < $times-1; $i++){
        $tab .= "\t";
    }
    return $tab;
}

function capitalize($string,$space='_'){
    $arr = explode($space,$string);
    foreach($arr as $word) 
        $str .= ucfirst($word);
        
    return $str;
}