<?php

/**
 * ScheduleDetailTravelTimeAndDateValidator.
 *
 * @package    polosac
 * @subpackage validator
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class ScheduleDetailTravelTimeAndDateValidator extends sfGlobalValidator
{
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('invalid', 'Lo Sentimos, ya paso el tiempo limite para asignar pasajeros a este viaje.');
  }
  
  protected function doClean($value)
  {
    if (!is_array($value))
    {
      throw new sfValidatorError($this, 'invalid');
    }
    
    $scheduleDetail = Doctrine::getTable('ScheduleDetail')->findOneById($value['id']);
    
    $fecha_de_viaje        = $scheduleDetail->getSchedule()->getTravelDate();
    $hora_de_viaje         = $scheduleDetail->getSchedule()->getTravelTime();
    $cantidad_horas_limite = sfConfig::get('app_cantidad_horas_limite');

    $limit_date            = date("Y-m-d H:i:s", strtotime($fecha_de_viaje.''.$hora_de_viaje.' -'.$cantidad_horas_limite.' hours'));
      

    if(strtotime($limit_date) < strtotime(date('Y-m-d H:i:s')))
    {
      throw new sfValidatorError($this, 'invalid');
    }
    
    

    return $value;
  }
}
