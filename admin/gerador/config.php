<?php

/**
 * @author trashboy.mine.nu
 * @copyright 2010
 * @Application Gerador
 */
	error_reporting(E_PARSE);
    session_start();
    $conn = @mysql_connect($_SESSION['dadosBanco']['hostname'],$_SESSION['dadosBanco']['username'],$_SESSION['dadosBanco']['password'],true) or die (mysql_error());
    
    $arrTipoCampos = array(
                    'text_large'  => 'Texto',
                    'text_medium' => 'Texto Médio',
                    'text_small'  => 'Texto Peq.',
                    'hidden'      => 'Hidden',
                    'textarea'    => 'Textarea',
                    'password'    => 'Senha',
                    'checkbox'    => 'Checkbox',
                    'radio'       => 'Radio',
                    'select'      => 'Select',
                    
                    'cpf'         => 'CPF',
                    'cnpj'        => 'CNPJ',
                    'phone'       => 'Telefone',
                    'cep'         => 'Cep',
                    'date'        => 'Datapicker',
                    'datetime'    => 'Datetime',
                    'cidade'      => 'Cidade',
                    'estado'      => 'Estado'
                    );
    
    include('inc/functions.php');
    
    if( !mysql_select_db($_SESSION['dadosBanco']['database'],$conn) )
        $ERR[] = 'Ocorreu um erro ao selecionar o banco de dados'.mysql_error();

?>