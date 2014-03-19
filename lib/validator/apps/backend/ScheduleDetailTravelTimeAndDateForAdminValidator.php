<?php

/**
 * ScheduleDetailTravelTimeAndDateForAdminValidator.
 *
 * @package    polosac
 * @subpackage validator
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class ScheduleDetailTravelTimeAndDateForAdminValidator extends sfGlobalValidator
{
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('invalid', 'Solo puedes asignar pasajeros dentro las 2 horas antes de la partida del Bus .');
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
    $real_date             = date("Y-m-d H:i:s", strtotime($fecha_de_viaje.''.$hora_de_viaje));
      

    if(!((strtotime($limit_date) < strtotime(date('Y-m-d H:i:s'))) and (strtotime($limit_date) < strtotime($real_date))))
    {
      throw new sfValidatorError($this, 'invalid');
    }

    return $value;
  }
}
