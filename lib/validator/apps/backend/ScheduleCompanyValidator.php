<?php

/**
 * ScheduleCompanyValidator.
 *
 * @package    polosac
 * @subpackage validator
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class ScheduleCompanyValidator extends sfGlobalValidator
{
  protected function configure($options = array(), $messages = array())
  {


    $this->setMessage('invalid', 'La empresas solo deben tener un registro por Viaje.');
  }
  
  protected function doClean($value)
  {
    if (!is_array($value))
    {
      throw new sfValidatorError($this, 'invalid');
    }

    
        $details = $value['schedule_detail_container'];
        
        $datos = array();
        $error = false;
        
        foreach($details as $detail)
        {
            @$datos[$detail['company_id']] = (($datos[$detail['company_id']] == null)?0:$datos[$detail['company_id']]) + 1;
        }
        
        foreach ($datos as $dato)
        {
            if($dato > 1)
            {
                $error = true;
            }
        }
        
        
        if($error)
        {
            throw new sfValidatorError($this, 'invalid');
        }
        
        

 
    return $value;
  }
}
