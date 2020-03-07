<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- <p style="text-align: center">Academia Hora do Recreio</p>
<p style="text-align: center; font-style: italic; font-size: 11px;"><?php echo @$info_filial[0]->descricao;?></p>
<p style="text-align: center; font-style: italic; font-size: 11px;"><?php echo "CNPJ: " . @$info_filial[0]->cnpj;?></p>
<p style="text-align: center; font-style: italic; font-size: 11px;"><?php echo @$info_filial[0]->endereco . " - " . @$info_filial[0]->numero;?></p>
<p style="text-align: center; font-style: italic; font-size: 11px;"><?php echo "Telefone: " . @$info_filial[0]->fone;?></p>
<p style="text-align: center">Relatório de Mensalidades Pagas no mês: <?php echo date("m/Y");?></p> -->

<p style="font-weight:bolder; font-size:26px; text-align:center;">DECLARAÇÃO<p>
<p style="text-align:justify; line-height:5em; font-size:14px; text-indent: 2em;">Declaramos que Maria Isabel, atendida pelo profissional Claudio Luz na especialidade PSICOLOGIA, pelo plano de saúde UNIMED, esteve
em </p>
<p style="text-align:justify; line-height:5em; font-size:14px; text-indent: 2em;">consulta marcada no dia 30/05/2019, Segunda-feira às 08h30, e teve a sua consulta marcada como PRESENÇA, confirmada pelo profissional
que o </p>
<p style="text-align:justify; line-height:5em; font-size:14px; text-indent: 2em;">atendeu.</p>
<p style="text-align:center">_________________________________________________</p>
<p style="text-align:center">Claudio Luz - PSICOLOGO<p>
<p style="text-align:center">CRP: 15147-9</p>
<h3> Forma de Pagamento:  </h3>
		<div class="base-ficha min-height">
			<table class="table table-bordered" cellspacing="0" rules="none" cellpadding="0">
				<thead>
					<tr>
						<th width="410">Nome do Paciente: Maria Isabel </th>
						<th width="80">Valor: 0.00</th>
						<th width="80">Vencimento: 30/05/2019</th>
						<th width="80">Dia Pgto: 30/05/2019</th>
					</tr>
				</thead>
				<tbody>
					
						<tr>
							<td>Maria Isabel</td>
							<td>R$ 00.00</td>
							<td><?php echo date("d/m/Y");?></td>
							<td><?php echo date("d/m/Y");?></td>
						</tr>
				
				</tbody>
			</table>
		 </div>


<p style="text-align: center">Valor Total: </p>
	<br/>
<p style="text-align: center"></p>
	<br/>
<div class="footer">
    <span class="pagenum"></span>
</div>
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
.header,
.footer {
    width: 100%;
}
.header {
    top: 0px;
    border-bottom: 2px #000 solid;
    text-align: right;
    position: fixed;
}
.footer {
    bottom: 0px;
    text-align: center;
    position: fixed;
}
.pagenum:before {
    content: counter(page);
}
.header .cabecalho {
    font-weight: bold;
    font-style: italic;
}
.page-break-before{page-break-before: always}
.page-break-after{page-break-after: auto}
p{line-height: 10px !important;}
h3{font-size: 20px !important; font-weight: bold !important; background-color: #aaa !important; color:#fff;padding: 7px !important; margin: 0 0 5px 0 !important;}
.cabecalho{margin-bottom: 50px !important;}
.cabecalho p{margin: 0 !important; padding: 0 !important;}
.min-height{line-height: 10px;}
.font-20{font-size: 20px !important; }

.bold{font-weight: bold !important;}
.text-center{text-align: center !important;}

.titulo{background-color: #ddd !important; color:#fff !important;}

.base-ficha{padding: 0 5px !important; width: 50em; margin: 0.8em; text-align: justify !important;}
.linha {
	width: 45em;
	height: 2em;
}
.dados-esquerda {
	width: 30em;
	height: 0.8em;
	float: left;
	display: inline-block;
	padding: 0.5em;
}
.dados-direita {
	width: 15em;
	height: 0.8em;
	float: left;
	display: inline-block;
	padding: 0.5em;
}
.dados {
	width: 21.5em;
	height: 10em;
	padding: 0.5em;
	display: inline-block;
	background-color: red;
}
thead:before, thead:after { display: none; border:0 !important;}
tbody:before, tbody:after { display: none; border:0 !important}
td, tr, th {
	border: 0 !important;
}

thead {
	border:0 !important;
}

tbody {
	border:0 !important;
}
table {
	border:0 !important;
}
</style>


