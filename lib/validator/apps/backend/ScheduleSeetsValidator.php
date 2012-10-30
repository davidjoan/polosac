<?php

/**
 * ScheduleSeetsValidator.
 *
 * @package    polosac
 * @subpackage validator
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class ScheduleSeetsValidator extends sfGlobalValidator
{
  protected function configure($options = array(), $messages = array())
  {


    $this->setMessage('invalid', 'La suma de la cantidad de asientos para cada empresa debe ser menor a la disponible en el BUS.');
  }
  
  protected function doClean($value)
  {
    if (!is_array($value))
    {
      throw new sfValidatorError($this, 'invalid');
    }

        
        $bus          = Doctrine::getTable('Bus')->findOneById($value['bus_id']);
        $qty_of_seats = $bus->getRealQtyOfSeats();
        
        $details = $value['schedule_detail_container'];
        
        $real_qty = 0;
        
        foreach($details as $detail)
        {
            $real_qty = $real_qty + $detail['qty_seats'];
        }
        
        if($real_qty > $qty_of_seats)
        {
            throw new sfValidatorError($this, 'invalid');
        }
        
        

 
    return $value;
  }
}
