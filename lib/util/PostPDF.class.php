<?php

/**
 * PostPDF
 *
 * @package    polosac
 * @subpackage lib
 * @author     David Joan Tataje Mendoza <dtataje@datasolutions.pe>
 */
class PostPDF extends FPDF
{
  public $post; 
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
  
  function PostPDF($orientation='P', $unit='mm', $size='A4', $post)
  {
    $this->post = $post;  	
    parent::FPDF($orientation,$unit,$size);
  }

  function Header()
  {
    $this->SetFont('Arial','B',15);
    $this->Cell(45);
    $titulo = $this->post->getTitle();
    $this->Cell(80,10,utf8_decode($titulo),0,0,'C');

    $this->SetFont('Arial','B',12);
    $this->Cell(15);
    $this->Cell(30,5,'Fecha',0,0,'C');
    $this->Ln();
    $this->SetFont('Arial','I',12);
    $this->Cell(140);
    $this->Cell(30,5,date('d/m/Y'),0,0,'C');    
  }

  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $footer = 'POLO S.A.C. - Página ';
    $this->Cell(0,10,utf8_decode($footer).$this->PageNo(),0,0,'C');
  }

 
  

 

  function OpenTag($tag, $attr)
  {
    // Etiqueta de apertura
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
  }

  function CloseTag($tag)
  {
    // Etiqueta de cierre
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
  }

  function SetStyle($tag, $enable)
  {
    // Modificar estilo y escoger la fuente correspondiente
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
  }

  function PutLink($URL, $txt)
  {
    // Escribir un hiper-enlace
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}  
  
function WriteHTML($html)
{
    // Intérprete de HTML
    $html = str_replace("\n",' ',$html);
    $html = str_replace("&aacute;",utf8_decode('á'),$html);
    $html = str_replace("&eacute;",utf8_decode('é'),$html);
    $html = str_replace("&iacute;",utf8_decode('í'),$html);
    $html = str_replace("&oacute;",utf8_decode('ó'),$html);
    $html = str_replace("&uacute;",utf8_decode('ú'),$html);
    
    
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Etiqueta
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extraer atributos
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
  }  
}