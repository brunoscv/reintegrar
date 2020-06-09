<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function __construct($rules = array()) {
        parent::__construct($rules);
    }

    function is_uploaded($content) {
        if (is_array($content)) {
            parent::set_message('is_uploaded', '<b>%s</b>: ' . $content['error']);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function cpf_valid($cpf) {
        // funcao de validacao de CPF sem pontos e tracos;
        $cpf = preg_replace("/([-.])/", "", $cpf);

        if (!is_numeric($cpf))
            return false;

        if (strlen($cpf) != 11 || preg_match("/^(1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}|0{11})$/", $cpf))
            return false;

        $dv = substr($cpf, 9, 2);

        $pos = 10;
        $sum = 0;
        foreach (str_split(substr($cpf, 0, 9)) as $n) {
            $sum += $n * $pos;
            $pos--;
        }
        $dv_verify[0] = ( ($sum % 11) < 2) ? 0 : 11 - ($sum % 11);

        $pos = 11;
        $sum = 0;
        foreach (str_split(substr($cpf, 0, 10)) as $n) {
            $sum += $n * $pos;
            $pos--;
        }
        $dv_verify[1] = ( ($sum % 11) < 2) ? 0 : 11 - ($sum % 11);
        $dv_verify = (string) $dv_verify[0] . $dv_verify[1];

        if ($dv_verify != $dv)
            return FALSE;

        return TRUE;
    }

    function cnpj_valid($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    function cep_valid($str, $cep) {
        if (preg_match("/^([0-9]{5})-([0-9]{3})$/", $str))
            return TRUE;

        return FALSE;
    }
	
	function datetime_valid($date){
		list($date, $time) = explode(" ", $date);
		if( $this->date($date) ){
			list($H, $M, $S) = explode(":",$time);
			
			$H = intval($H);
			$M = intval($M);
			$S = intval($S);
			
			if( $H <= 23 &&  $H >= 0){
				if( $M <= 59 && $M >= 0 ){
					if( $S <= 59 && $S >= 0 ){
						return TRUE;
					}	
				}
			}
		}
		return FALSE;
	}

    function date_valid($date) {
        if (preg_match("/^(0[0-9]|[1,2][0-9]|3[0,1])\/(0[0-9]|1[0,1,2])\/([0-9]{4})$/", $date)) {
            list($d, $m, $Y) = explode("/", $date);
            if (checkdate($m, $d, $Y))
                return TRUE;
            return FALSE;
        }
        return FALSE;
    }

    function is_unique($str, $attr) {
		list($table, $field) = explode('.', $field);
		$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
		
		return $query->num_rows() === 0;
    }

}