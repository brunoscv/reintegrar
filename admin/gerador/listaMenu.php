<?php
    include('config.php');
    
    if( $conn ){
        if( empty($_GET['menu']) ){ ?>
            Nome: <input type="text" name="descricao" /> Ord.:<input type="text" name="ordem" size="1" /><input type="hidden" name="menu_id" value="" />
        <?php } else { ?>
            Nome: <input type="text" name="descricao" /> Ord.:<input type="text" name="ordem" size="1" /><input type="hidden" name="menu_id" value="<?php echo $_GET['menu'] ?>" />
            <?php } ?>
        <a href="#" onclick='loadAjax("salvaMenu.php?descricao="+$("input[name=descricao]").attr("value")+"&menu_id="+$("input[name=menu_id]").attr("value")+"&ordem="+$("input[name=ordem]").attr("value"), $("#menuLine"));'>Salvar Menu</a>
        <?php 
    } else {
        $ERR[] = 'Ocorreu um erro ao tentar conectar selecionar o Menu';
    }