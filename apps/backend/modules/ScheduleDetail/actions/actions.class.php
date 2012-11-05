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
    return array('s'  => array('schedule_date' => 'travel_date', 'schedule_time' => 'travel_time'), 
                 'c'  => array('company_name' => 'name'),
                 'b'  => array('bus_name' => 'name'),
                 'pf' => array('place_from_name' => 'name'),
                 'pt' => array('place_to_name' => 'name'));
  }    
  
  protected function complementEdit(sfWebRequest $request)
  {
      $this->form   = new ScheduleDetailClientForm($this->object);
  }
  
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
  }
  
  
  protected function complementSave(sfWebRequest $request)
  {
       $mensage = Swift_Message::newInstance()
		  ->setFrom(sfConfig::get('app_email_notification_from'))
                  ->setTo(sfConfig::get('app_email_notifications'))
		  ->setSubject(sfConfig::get('app_email_subject'))
		  ->setBody($this->getPartial('notification'), 'text/html');
 
             $this->getMailer()->send($mensage); //enable in production
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
  		                  'title' => $dato->getSchedule()->getNumber().'.- '.$dato->getSchedule()->getTravelTime().' | '.$dato->getSchedule()->getBus().' | '.$dato->getActiveStr(),
  		                  'start' => $dato->getSchedule()->getFormattedTravelDate('yyyy-MM-dd').' '.$dato->getSchedule()->getTravelTime(),
  		                  'url' => sfContext::getInstance()->getRouting()->generate('schedule_detail_edit', array('slug' => $dato->getSlug())),
  		                  'color' => ($dato->getActive() == 1 )?'#7D58EE':'#C31434'
  		                  
  		     );
  	}
  	return $this->renderJson($result);
  }  
}
