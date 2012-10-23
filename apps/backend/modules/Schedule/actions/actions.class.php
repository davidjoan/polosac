<?php

/**
 * Schedule actions.
 *
 * @package    polosac
 * @subpackage Schedule
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScheduleActions extends ActionsCrud
{
  protected function getExtraFilterAndArrangeFields()
  {
    return array('b' => array('bus_name' => 'name'), 
                'pf' => array('place_from_name' => 'name') , 
                'pt' => array('place_to_name' => 'name'));
  }
  
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
    sfDynamicFormEmbedder::resetParams('schedule_detail');
  }  
  
  public function executeProgramacion(sfWebRequest $request)
  {
  	$datos = Doctrine::getTable('Schedule')->findAll();
  	$result = array();
  	
  	foreach($datos as $key => $dato)
  	{
  		$result[$key] = array
  		                (
  		                  'id' => $dato->getId(),
  		                  'title' => $dato->getTravelTime().' | '.$dato->getBus().' | '.$dato->getActiveStr(),
  		                  'start' => $dato->getFormattedTravelDate('yyyy-MM-dd').' '.$dato->getTravelTime(),
  		                  'url' => sfContext::getInstance()->getRouting()->generate('schedule_edit', array('slug' => $dato->getSlug())),
  		                  'color' => ($dato->getActive() == 1 )?'#7D58EE':'#C31434'
  		                  
  		     );
  	}
  	return $this->renderJson($result);
  }
  
  public function executeReport(sfWebRequest $request)
  {
    sfConfig::set('sf_web_debug', false);
    $slug    = $request->getParameter('slug');
    
    $schedule = Doctrine::getTable('Schedule')->findOneBySlug($slug);
    $this->forward404Unless($schedule);
    
    $pdf = new ReportPolosacFPDF('P', 'mm', 'A4', $schedule);
    $pdf->AddPage(); 
    $pdf->Ln(1);
    

    $pdf->Image(sfConfig::get('sf_web_dir') .'/images/general/logo.png',10,10,31);
    $pdf->Image(sfConfig::get('sf_web_dir') .'/images/general/numero1.png',155,10,23);
   
    
    $pdf->Ln(2);  
    
    $header = array('N°', 'APELLIDOS Y NOMBRES', 'DNI', 'EMPRESA', 'EMBARQUE','DESEMBARQUE', 'FIRMA', 'SS. HH.');
    $records = Doctrine::getTable('ScheduleDetailPassenger')->getList($slug);    

    $pdf->FancyTable($header,$records);
    
    $pdf->Output(sprintf('polosac-reporte-%s.pdf',Doctrine_Inflector::urlize($schedule->getFormattedTravelDate())),'D');
   
    throw new sfStopException();        
  }  
  
}
