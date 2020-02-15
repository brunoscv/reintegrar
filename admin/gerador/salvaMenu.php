<?php

/**
 * @author trashboy.mine.nu
 * @copyright 2010
 */

include('config.php');

$rules = array('descricao');
foreach($rules as $rule){
    if( $_GET[$rule] == "" )
        $ERR[] = 'O campo '. $rule. ' &eacute; obrigat&oacute;rio';
}
if( !isset($ERR) ){
    if( $_GET['menu_id'] != "" )
        $query = "INSERT INTO menus (descricao,menu_id) VALUE ('".$_GET['descricao']."','".$_GET['menu_id']."')";
    else
        $query = "INSERT INTO menus (descricao) VALUE ('".$_GET['descricao']."')";
	echo $query;
    mysql_query($query);
} else {
    foreach($ERR as $e)
        echo $e."<br />";
}

$query = "SELECT n.id, (select m.descricao from menus as m where m.id = n.menu_id) as pai, n.descricao FROM menus as n ORDER BY n.menu_id ASC, n.descricao ASC";
$result = mysql_query($query);
while( $menu = mysql_fetch_array($result,MYSQL_ASSOC) ){
    $listaMenu[ $menu['id'] ] = ( !empty($menu['pai']) ) ? $menu['pai'] . ' -&gt ' . $menu['descricao'] : $menu['descricao'] ;
}
?>
Menu: <select name="menu" onchange="loadAjax( 'listaMenu.php?menu='+this.value,$('#menu') );"><option>Selecione uma Menu</option><?php echo makeOptions($listaMenu); ?><option>Adicionar Menu</option></select><span id="menu"></span>