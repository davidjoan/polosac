<?php

/**
 * ScheduleDetail actions.
 *
 * @package    polosac
 * @subpackage ScheduleDetail
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScheduleDetailActions extends ActionsCrud
{
  protected function getExtraFilterAndArrangeFields()
  {
    return array('s' => array('schedule_date' => 'travel_date', 'schedule_time' => 'travel_time'), 
                 'c' => array('company_name' => 'name'),
                 'b' => array('bus_name' => 'name'));
  }    
  
  protected function complementEdit(sfWebRequest $request)
  {
      $this->form   = new ScheduleDetailClientForm($this->object);
  }
  
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
  }
  
    public function executeProgramacion(sfWebRequest $request)
  {
  	$datos = Doctrine::getTable('ScheduleDetail')->getCalendarClient();
  	$result = array();
  	
  	foreach($datos as $key => $dato)
  	{
  		$result[$key] = array
  		                (
  		                  'id' => $dato->getId(),
  		                  'title' => $dato->getSchedule()->getTravelTime().' | '.$dato->getSchedule()->getBus().' | '.$dato->getActiveStr(),
  		                  'start' => $dato->getSchedule()->getFormattedTravelDate('yyyy-MM-dd').' '.$dato->getSchedule()->getTravelTime(),
  		                  'url' => sfContext::getInstance()->getRouting()->generate('schedule_detail_edit', array('slug' => $dato->getSlug())),
  		                  'color' => ($dato->getActive() == 1 )?'#7D58EE':'#C31434'
  		                  
  		     );
  	}
  	return $this->renderJson($result);
  }  
}
