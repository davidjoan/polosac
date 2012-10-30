<?php

/**
 * ScheduleCompanyValidator.
 *
 * @package    polosac
 * @subpackage validator
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class ScheduleDetailSeatsValidator extends sfGlobalValidator
{
  protected function configure($options = array(), $messages = array())
  {
    $this->setMessage('invalid', 'Solo puedes seleccionar la cantidad de pasajeros que se le asigno para este viaje.');
  }
  
  protected function doClean($value)
  {
    if (!is_array($value))
    {
      throw new sfValidatorError($this, 'invalid');
    }
    
    $passengers =$value['passenger_list'];
    
    $quantity = count($passengers);
    
    $total_seats = $value['qty_seats_hidden'];


        if($quantity>$total_seats)
        {
            throw new sfValidatorError($this, 'invalid');
        }

    return $value;
  }
}
