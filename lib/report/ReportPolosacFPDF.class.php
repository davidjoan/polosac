<?php

/**
 * PostPDF
 *
 * @package    polosac
 * @subpackage lib
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 */
class ReportPolosacFPDF extends FPDF
{
  public $schedule; 
  public $B;
  public $I;
  public $U;
  public $HREF;

  function PDF($orientation='P', $unit='mm', $size='A4')
  {
    //Llama al constructor de la clase padre
    $this->FPDF($orientation,$unit,$size);
    //Iniciación de variables
    $this->B = 0;
    $this->I = 0;
    $this->U = 0;
    $this->HREF = '';
  }
  
  function ReportPolosacFPDF($orientation='P', $unit='mm', $size='A4', $schedule)
  {
    $this->schedule = $schedule;  	
    parent::FPDF($orientation,$unit,$size);
  }

  function Header()
  {
    $this->SetFont('Arial','BU',8);
    $this->Cell(38);
    $titulo = 'INVERSIONES Y REPRESENTACIONES POLO SAC - RUC 20503370574';//$this->post->getTitle();
    $this->Cell(100,8,utf8_decode($titulo),0,0,'C');
    $this->SetFont('Arial','BU',12);
    
    $this->Ln();
    $this->Cell(38);
    $titulo = 'MANIFIESTO DE PASAJEROS';
    $this->Cell(100,8,utf8_decode($titulo),0,0,'C');
    
    $this->SetFont('Arial','B',15);
    $this->Cell(40,10,utf8_decode($this->schedule->getNumber()),1,0,'C');
    
    
    $this->SetFont('Arial','BU',12);
    $this->Ln();
    $this->Cell(38);
    $placa = 'PLACA : '.$this->schedule->getBus()->getCode();
    $card = 'Nº T. C. : '.$this->schedule->getBus()->getCirculationCardNumber();
    $this->SetFont('Arial','BU',8);
    $this->Cell(50,8,utf8_decode($placa),0,0,'C');
    $this->Cell(50,8,utf8_decode($card),0,0,'C');
    
    $crews = $this->schedule->getBus()->getCrews();
    
    $piloto_c["name"] = $piloto_c["licence"] = $piloto_a["name"] = $piloto_a["licence"] = $piloto_b["name"] = $piloto_b["licence"] = null;
     
    
    foreach($crews as $crew)
    {
        if($crew->getPosition() == CrewTable::PILOT_A)
        {
          $piloto_a["name"] = $crew->getName();
          $piloto_a["licence"] = $crew->getDriverLicense();            
        }
        
        if($crew->getPosition() == CrewTable::PILOT_B)
        {
          $piloto_b["name"] = $crew->getName();
          $piloto_b["licence"] = $crew->getDriverLicense();            
        }
        
        if($crew->getPosition() == CrewTable::AUXILIAR)
        {
          $piloto_c["name"] = $crew->getName();
          $piloto_c["licence"] = $crew->getDni();            
        }        
        
    }

    $this->Ln();
    $dia = $this->schedule->getFormattedTravelDate();
    $this->SetFont('Arial','B',9);
    $this->Cell(35,8,"DIA",1,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(35,8,utf8_decode($dia),1,0,'C');
    $this->Cell(10);
    $this->SetFont('Arial','B',9);
    $this->Cell(22,8,"PILOTO A",1,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(61,8,utf8_decode($piloto_a["name"]),1,0,'C');
    $this->Cell(22,8,utf8_decode($piloto_a["licence"]),1,0,'C');
    $this->Ln();
    
    $hora = $this->schedule->getTravelTime();
    $this->SetFont('Arial','B',9);
    $this->Cell(35,8,"HORA DE SALIDA",1,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(35,8,utf8_decode($hora),1,0,'C');
    $this->Cell(10);
    $this->SetFont('Arial','B',9);
    $this->Cell(22,8,"PILOTO B",1,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(61,8,utf8_decode($piloto_b["name"]),1,0,'C');
    $this->Cell(22,8,utf8_decode($piloto_b["licence"]),1,0,'C');
    $this->Ln();
    
    $viaje = sprintf('%s - %s',$this->schedule->getPlaceFrom()->getName(), $this->schedule->getPlaceTo()->getName());
    $this->SetFont('Arial','B',9);
    $this->Cell(35,8,"VIAJE",1,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(35,8,utf8_decode($viaje),1,0,'C');
    $this->Cell(10);
    $this->SetFont('Arial','B',9);
    $this->Cell(22,8,"T. AUXILIAR",1,0,'L');
    $this->SetFont('Arial','',8);
    $this->Cell(61,8,utf8_decode($piloto_c["name"]),1,0,'C');
    $this->Cell(22,8,utf8_decode($piloto_c["licence"]),1,0,'C');
    $this->Ln();    
    
    
  }
  
  
  function FancyTable($header, $data)
  {
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(70,130,180);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(10,55,20, 35,24,25,15);
    for($i=0;$i<count($header);$i++)
    { 
      $this->Cell($w[$i],6,utf8_decode($header[$i]),1,0,'C',true);
    }
    $this->Ln();
    // Restauración de colores y fuentes
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],4,$row[0],'LR',0,'C',$fill);
        $this->Cell($w[1],4,utf8_decode($row[1]),'LR',0,'L',$fill);
        $this->Cell($w[2],4,utf8_decode($row[2]),'LR',0,'C',$fill);
        $this->Cell($w[3],4,utf8_decode($row[3]),'LR',0,'C',$fill);
        $this->Cell($w[4],4,utf8_decode($row[4]),'LR',0,'C',$fill);
        $this->Cell($w[5],4,utf8_decode($row[5]),'LR',0,'C',$fill);
        $this->Cell($w[6],4,"",'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
  }  

  function Footer()
  {
    $this->SetY(-15);  
    $this->Line(50, 280,100, 280);
    $this->Line(110, 280,160, 280);
    $this->SetFont('Arial','B',9);
    $this->Cell(40);
    $this->Cell(50,8,"Piloto A",0,0,'C');    
    $this->Cell(10);
    $this->Cell(50,8,"Piloto B",0,0,'C');    
    $this->Cell(40);
    
    $this->SetY(-10);
    $this->SetFont('Arial','I',8);
    $footer = 'POLOSAC - Página ';
    $this->Cell(0,10,utf8_decode($footer).$this->PageNo(),0,0,'C');
    
    

  } 
}