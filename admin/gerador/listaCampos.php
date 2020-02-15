<?php

/**
 * @author trashboy.mine.nu
 * @copyright 2010
 */
    include('config.php');

    if( $conn ){
        $query = "SHOW COLUMNS FROM ".$_GET['tabela'];
        $result = mysql_query($query);
        ?>
        <table border="1" width="100%">
            <col width="1" />
            <col width="1" />
            <col width="1" />
            <col width="1" />
            <col width="1" />
            <col width="1" />
            <col width="10" />
            <col width="400" />
            <thead>
                <tr>
                    <th>Campo</th>
                    <th>Form</th>
                    <th>Lista</th>
                    <th>Tipo/Banco</th>
                    <th>Tipo/Campo</th>
                    <th>Alias do Campo</td>
                    <th>Validacao</th>
                    <th>Relacionamento</th>
                </tr>
            </thead>
            <tbody>
        <?php
        $i=0;
        while( $campo = mysql_fetch_array($result) ){
            ?>
                <tr class="<?php echo ( $i % 2 == 1 ) ? 'odd' : NULL ; ?>" >
                    <td><?php echo $campo['Field'].hidden('field['.$i.'][name]',$campo['Field']) ?></td>
                    <td><?php echo checkbox('field['.$i.'][form]','1'); ?></td>
                    <td><?php echo checkbox('field['.$i.'][lista]','1'); ?></td>
                    <td><?php echo $campo['Type'] ?></td>
                    <td><?php echo select('field['.$i.'][tipo]',array('options'=>$arrTipoCampos)) ?></td>
                    <td><input type="text" name="field[<?php echo $i ?>][field]" value="<?php echo $campo['Field'] ?>" /></td>
                    <?php if( $campo['Null'] == 'YES' ): ?>
                    <td><input type="text" name="field[<?php echo $i ?>][validacao]" value="" /></td>
                    <?php else: ?>
                    <td><input type="text" name="field[<?php echo $i ?>][validacao]" value="required" /></td>
                    <?php endif; ?>
                    <td>
                    <?php if( eregi('_id',$campo['Field']) ):
                        unset($listaCampos);
                        $tabela = str_replace('_id','',$campo['Field']);
                        $query = "SHOW COLUMNS FROM ".($tabela);
                        $result2 = mysql_query($query);
                        while( $campo = mysql_fetch_array($result2) )
                            $listaCampos[ $campo['Field'] ] = $campo['Field'];
                    ?>
                        <select name="field[<?php echo $i ?>][busca_tipo]">
                            <option value="select">Tipo de Relacionamento</option>
                            <option value="select">Select</option>
                            <option value="master">Master</option>
                        </select>
                        <select name="field[<?php echo $i ?>][busca_campo]">
                            <option value="select">Campo para a Busca</option>
                            <?php echo makeOptions($listaCampos) ?>
                        </select>
                    <?php endif; ?>
                    </td>
                </tr>            
            <?php
            $i++;
        }
        ?>
            </tbody>
        </table>
        <center>
            <input type="submit" value="Gerar Arquivos" />
        </center>
        <?php
    } else {
        $ERR[] = 'Ocorreu um erro ao tentar conectar com o banco de dados';
    }
?>