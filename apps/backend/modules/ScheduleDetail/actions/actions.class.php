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
      if($this->getUser()->isAdmin())
      {
          
          
    $scheduleDetail = Doctrine::getTable('ScheduleDetail')->findOneById($this->object->getId());
    
    $fecha_de_viaje        = $scheduleDetail->getSchedule()->getTravelDate();
    $hora_de_viaje         = $scheduleDetail->getSchedule()->getTravelTime();
    $cantidad_horas_limite = sfConfig::get('app_cantidad_horas_limite');

    $limit_date            = date("Y-m-d H:i:s", strtotime($fecha_de_viaje.''.$hora_de_viaje.' -'.$cantidad_horas_limite.' hours'));
    $real_date             = date("Y-m-d H:i:s", strtotime($fecha_de_viaje.''.$hora_de_viaje));
      

    if((strtotime($limit_date) < strtotime(date('Y-m-d H:i:s'))) and (strtotime($limit_date) < strtotime($real_date)))
    {
        
       $emails = Doctrine::getTable('User')->getEmailBosses($this->object->getCompany()->getSlug());
       $mensage = Swift_Message::newInstance()
		  ->setFrom(sfConfig::get('app_email_notification_from'))
                  ->setTo(array_merge(sfConfig::get('app_email_notifications'), $emails))
		  ->setSubject(sfConfig::get('app_email_subject'))
		  ->setBody($this->getPartial('notification', array('schedule_detail' => $this->object)), 'text/html');
 
       //Deb::print_r($mensage->toString());
             $this->getMailer()->send($mensage); //enable in production      
             
    }
    
    
    
      }

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
