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
  
}
