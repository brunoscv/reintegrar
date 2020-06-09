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
	    $this->Cell(30,10, @$this->params['titulo'], 0,0,'C'); //titulo do relatorio

	    $this->SetFont('Arial','B',8);
	    $adicional = count($this->params['widths']) == 32 ? 6 : 0;
	    $this->Cell(186+$adicional);
	    $this->MultiCell(28,6, @$this->params['relatorioId'], 1,'R'); //titulo do relatorio
	    
	    $this->Ln(-7);

	    $this->Cell(18);
	    $this->SetFont('Arial',"",8);
	    $this->Cell(30,10, @$this->params['subtitulo'],0,0,'C'); //subtitulo do relatorio
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
	    $startDias = $this->params['startDias'];
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],4,$header[$i],1,0,'C',true);

	    $this->Ln();
	    $this->SetFillColor(180,180,180);

	    $this->Cell($w[0],4,"",1,0,'C',true);
	    $this->Cell($w[1],4,"",1,0,'C',true);
	    
	    if( array_search("COREN", $header) ){
	    	$this->Cell($w[2],4,"",1,0,'C',true);
		}
		
		$diasSemana = array("DOM","SEG","TER","QUA","QUI","SEX","SAB");
		$calendar = $this->params['calendar'];
		for($i=1; $i<=$calendar['quantidade_dias']; $i++){
			$diaSemana = date('w', mktime(0, 0, 0, $calendar['mes'], $i, $calendar['ano'])); 
			$fds = ( in_array($diaSemana, array(0,6)) ) ? "fds" : "";
			$this->Cell($w[$i+$startDias],4, $diasSemana[$diaSemana],1,0,'C',true);
		}
	    
	    $this->Ln();
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