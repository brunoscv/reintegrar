<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require( FCPATH . APPPATH . "third_party/fpdf/fpdf.php");
class PDF extends FPDF{
	private $params;
	
	function setParametrosRelatorio($parametros){
		$this->params = $parametros;
	}

	function Header(){
	    //$this->Image(FCPATH . 'assets/images/logo-top.png',10,6,30);
	    $this->SetFont('Arial','B',15);
	    $this->Cell(27);
	    $this->Cell(30,10, @utf8_decode($this->params['titulo']), 0, 0,'C'); //titulo do relatorio

	    if( isset($this->params['filtro']) ){
	    	$filtros = "";
	    	
	    	$ln = 0;
	    	if( !@empty($this->params['filtro']['funcionario']) ){
	    		$filtros .= "\n".utf8_encode("Funcionário:") . $this->params['filtro']['funcionario'];
	    		$ln -= 2;
	    	}

	    	if( !@empty($this->params['filtro']['fornecedor']) ){
	    		$filtros .= "\nFornecedor: " . $this->params['filtro']['fornecedor'];
	    		$ln -= 2;
	    	}

	    	if( !@empty($this->params['filtro']['impressa']) ){
	    		$filtros .= "\nSomente Impressas: SIM";
	    		$ln -= 2;
	    	}

		    $this->SetFont('Arial','',8);
		    $this->Cell(149);
		    $this->MultiCell(60,4, "FILTROS DO RELATÓRIO". utf8_decode($filtros), 1, 'L'); //titulo do relatorio
		    $this->Ln($ln);
		} else {
			$this->Ln(5);	
		}
		

	    $this->Cell(27);
	    $this->SetFont('Arial',"",8);
	    $this->Cell(30,10, @utf8_decode($this->params['subtitulo']),0,0,'C'); //subtitulo do relatorio
	    $this->Ln(15);

	    $this->SetFont('Arial','',6);
			
		$this->SetFillColor(150,150,150);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(100,100,100);
	    $this->SetLineWidth(.1);
	    $this->SetFont('','B');
	    // Header
	    $w = $this->params['widths'];
	    $header = $this->params['tableHeader'];
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],4, utf8_decode($header[$i]),1,0,'C',true);

	    $this->Ln();
	    $this->SetFillColor(180,180,180);
	    
	}

	function Footer(){
	    $this->SetY(-15);
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
	    $this->SetY(-11);
	    $this->SetX(-515);
	    $this->Cell(0,1,'Arquivo gerado em '.date("d/m/Y H:i:s"),0,0,'C');
	}
}