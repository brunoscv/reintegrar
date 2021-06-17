<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['SimOuNao']			= array(FALSE=>"Não",TRUE=>"Sim");
$config['SimNao']			= array("0"=>"Não","1"=>"Sim");
$config['Sexos']			= array("M"=>"Masculino","F"=>"Feminino");
$config['tipoTransporte']	= array("NAO POSSUI"=>"Não possui","BICICLETA"=>"Bicicleta", "CARRO" => "Carro", "MOTO" => "Moto");
$config['IdiomasNiveis']	= array("Basico" => "Básico", "Intermediario" => "Intermediário", "Avancado" => "Avançado");
$config['Turnos']			= array("M" => "Manhã", "T" => "Tarde", "N" => "Noite", "I" => "Integral");
$config['SituacoesProcessos']	= array("ABERTO" => "Aberto", "ANDAMENTO" => "Em Andamento", "CONCLUIDO" => "Concluído");

$config['mesesAno'] = array('',"Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
$config['diaSemana'] = array("segunda"=>"Segunda", "terca"=>"Terça", "quarta"=>"Quarta", "quinta"=>"Quinta", "sexta"=>"Sexta", "sabado"=>"Sábado");
$config['tipoQuestoes'] = array("1"=>"Multipla Escolha", "2"=>"V/F");
$config['dificuldadeQuestoes'] = array("1"=>"Baixa", "2"=>"Média", "3"=>"Alta");
$config['valorAlternativas'] = array("1"=>"F", "2"=>"V");

//Arrays de configurações Reabilitar
$config['statusAgendamento'] = array("Cancelado"=>"Cancelado", "Pendente"=>"Pendente", "Realizado"=>"Realizado");
$config['formasPagamento'] = array("dinheiro"=>"Dinheiro", "debito"=>"Débito", "credito"=>"Crédito", "diversos" => "Diversos", "dp" => "Duplicata");
$config['motivoCancelamento'] = array("cancelado_cliente"=>"Cancelado pelo cliente", 
	                                  "falta_cliente"=>"Cliente não compareceu", 
	                                  "cancelado_profissional"=>"Cancelado pelo Profissional",
	                                  "falta_profissional"=>"Profissional não compareceu");
$config['filiais'] = array("1"=>"Unidade Master", "2"=>"Unidade Maceió", "3"=>"Unidade Belem", "4"=>"Unidade Teresina", "5"=>"Unidade Cuiabá");


$config['smtp_host'] = "";
$config['smtp_port'] = "587";
$config['smtp_user'] = "";
$config['smtp_pass'] = "";

$config['sms_url'] 	 	= FALSE;
$config['sms_user']		= "25"; //codigo
$config['sms_pass'] 	= ""; //token

/* End of file config.php */
/* Location: ./application/config/my_config.php */
