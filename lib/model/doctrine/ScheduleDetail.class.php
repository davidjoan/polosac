<?php

/**
 * ScheduleDetail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    polosac
 * @subpackage model
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ScheduleDetail extends BaseScheduleDetail
{
  public function getActiveStr()
  {  	
  	$actives = $this->getTable()->getStatuss();
  	return $actives[$this->getActive()];
  }    
    function getScheduleTravelDate()
    {
       return $this->getSchedule()->getFormattedTravelDate();
    }
    
    function getScheduleTravelTime()
    {
       return $this->getSchedule()->getTravelTime();
    }    
    
    function getScheduleBusName()
    {
        return $this->getSchedule()->getBus()->getName();
    }
    
    function getSlug()
    {
        return $this->getId();
    }
    
    function getBusName()
    {
        return $this->getScheduleBusName();
    }
}
