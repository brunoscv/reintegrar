<?php
header('Content-Type: text/html; charset=uft-8');
error_reporting(E_ALL);
function utf8_decode_array( $array ){
    foreach( $array as $k=>$v ){
        if( !is_array($v) )
            $r[$k] = utf8_decode($v);
        else
            $r[$k] = utf8_decode_array($v);
    }
    return $r;
}

$_POST = utf8_decode_array($_POST);

    include('config.php');
    if( $conn ){
        if( !is_dir('generated') )
            mkdir('generated');
        
        if( !is_dir('generated/config') )
            mkdir('generated/config');

        if( !is_dir('generated/controllers') )
            mkdir('generated/controllers');
        
        if( !is_dir('generated/views') )
            mkdir('generated/views');
        
        if( !is_dir('generated/models') )
            mkdir('generated/models');
        
        $modulo = $_POST['tabela'];
            
        #@mkdir('generated/controllers/'.plural($modulo));
        @mkdir('generated/views/modulos/'.strtolower(camelCase($modulo)),0777,TRUE);
        @mkdir('generated/config/form_validation', 0777, TRUE);
        
        //Validation
        $fp = fopen('generated/config/form_validation/'.strtolower(camelCase($modulo)).'.php','w+');
        fwrite($fp,"<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n");
        fwrite($fp,"\$config['".ucfirst(camelCase($modulo))."'] = array(\n");
        foreach($_POST['field'] as $field){
            if($field['form'] == '1'){
                fwrite($fp,tab(8)."array(\n");
                    fwrite($fp,tab(9)."'field' => \"".$field['name']."\",\n");
                    fwrite($fp,tab(9)."'label' => \"".htmlentities($field['field'])."\",\n");
                    fwrite($fp,tab(9)."'rules' => \"".$field['validacao']."\"\n");
                fwrite($fp,tab(9)."\t)");
                if( $field['busca_tipo'] == 'master' ){
                    fwrite($fp,",\n");
                    fwrite($fp,tab(8)."array(\n");
                        fwrite($fp,tab(9)."'field' => \"".$field['name']."_".$field['busca_campo']."\",\n");
                        fwrite($fp,tab(9)."'label' => \"".htmlentities($field['field'])."\",\n");
                        fwrite($fp,tab(9)."'rules' => \"".$field['validacao']."\"\n");
                    fwrite($fp,tab(9)."\t)");
                }
                fwrite($fp,",\n");
            }
        }
        fwrite($fp,");");
        fwrite($fp,"\n\n");
        fwrite($fp,"/* End of file ".strtolower(camelCase($modulo)).".php */\n");
        fwrite($fp,"/* Location: ./system/application/config/form_validation/".strtolower(camelCase($modulo)).".php */");
        fclose($fp);
        echo "Validation..: ".strtolower(camelCase($modulo)).".php<br />";
        //end validation;
        
        //geracao de views
        /*
$query = "INSERT INTO modulo (descricao,controller,method,ordem,menu_id) VALUES ('".$_POST['descricao']."','".plural(ucfirst($modulo))."','index','0','".$_POST['menu']."');";
@mysql_query($query);
$query = "INSERT INTO modulo (descricao,controller,method,ordem,menu_id) VALUES ('".$_POST['descricao']."','".plural(ucfirst($modulo))."','create','1','".$_POST['menu']."');";
@mysql_query($query);
$query = "INSERT INTO modulo (descricao,controller,method,ordem,menu_id) VALUES ('".$_POST['descricao']."','".plural(ucfirst($modulo))."','update','2','".$_POST['menu']."');";
@mysql_query($query);
$query = "INSERT INTO modulo (descricao,controller,method,ordem,menu_id) VALUES ('".$_POST['descricao']."','".plural(ucfirst($modulo))."','delete','3','".$_POST['menu']."');";
@mysql_query($query);
		*/

        //camposChave
        $camposChave = array();
        foreach($_POST['field'] as $field){
            if( !empty($field['busca_tipo']) )
                $camposChave[] = array(
                                    'tabela' => preg_replace('/_id$/','',$field['name']),
                                    'name'   => $field['busca_campo'],
                                 );
        }
        //end
        
        $pages = array(
                        'index',
                        'criar',
                        'editar',
                        'form',
                        'delete'
                    );
        $arrIndex = array('index', 'delete');
        
        foreach( $pages as $method ){
            ob_start();
            $campos = array();
            if( in_array($method,$arrIndex)  ){
                foreach($_POST['field'] as $field){
                    if($field['lista'] == 1){
                    	$campos[] = $field;
                    }
                }
                $camposLista = $campos;
            } elseif( in_array($method,array('form')) ){
                foreach($_POST['field'] as $field){
                    if($field['form'] == 1)
                        $campos[] = $field;
                }
                $camposForm = $campos;
            }
            include('template/views/'.$method.'.html');
            $content = ob_get_contents();
            $content = str_replace('{?','<?',$content);
            $content = str_replace('?}','?>',$content);
            ob_end_clean();
            file_put_contents('generated/views/modulos/'.strtolower(camelCase($modulo)).'/'.$method.'.php', $content);
            unset($content);
            unset($campos);
            echo ucfirst($method)."....: views/modulos/".strtolower(camelCase($modulo))."/".$method.".php<br />";
        }
        //end geracao de views
        #echo "<pre>";
        #print_r($_POST);
        ob_start();
        include('template/controllers/controller.php');
        $content = ob_get_contents();
        $content = str_replace('{?','<?',$content);
        $content = str_replace('?}','?>',$content);
        ob_end_clean();
        file_put_contents('generated/controllers/'.strtolower(camelCase($modulo)).'.php', $content);
        unset($content);
        unset($campos);
        echo "Controllers....: controllers/".strtolower(camelCase($modulo)).".php<br />";

        ob_start();
        include('template/models/models.php');
        $content = ob_get_contents();
        $content = str_replace('{?','<?',$content);
        $content = str_replace('?}','?>',$content);
        ob_end_clean();
        file_put_contents('generated/models/'.strtolower(camelCase($modulo)).'_model.php', $content);
        unset($content);
        unset($campos);
        echo "Models....: models/".strtolower(camelCase($modulo))."_model.php<br />";
		
        ob_start();
        include('template/assets/validate.js');
        $content = ob_get_contents();
        $content = str_replace('{?','<?',$content);
        $content = str_replace('?}','?>',$content);
        ob_end_clean();
		@mkdir( 'generated/assets/modulos/'.strtolower(camelCase($modulo)), 0777, TRUE );
        file_put_contents('generated/assets/modulos/'.strtolower(camelCase($modulo)).'/validate.js', $content);
        unset($content);
        unset($campos);
        echo "Assets....: controllers/".strtolower(camelCase($modulo)).".php<br />";

        ob_start();
        include('template/assets/js.js');
        $content = ob_get_contents();
        $content = str_replace('{?','<?',$content);
        $content = str_replace('?}','?>',$content);
        ob_end_clean();
		@mkdir( 'generated/assets/modulos/'.strtolower(camelCase($modulo)), 0777, TRUE );
        file_put_contents('generated/assets/modulos/'.strtolower(camelCase($modulo)).'/js.js', $content);
        unset($content);
        unset($campos);
        echo "Assets....: controllers/".strtolower(camelCase($modulo)).".php<br />";
        
        exit;
    }
?>