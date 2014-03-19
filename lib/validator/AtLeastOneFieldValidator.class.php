<?php

class AtLeastOneFieldValidator extends sfGlobalValidator
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addRequiredOption('column');

    $this->setMessage('invalid', 'Al menos uno de los siguientes campos no debe ser dejado vacío: "%column%".');
  }

  protected function doClean($values)
  {
    $keys = $this->getOption('column');
    foreach ($keys as $column)
    {
      if (!empty($values[$column]))
      {
        return $values;
      }
    }
    
    throw new sfValidatorError($this, 'invalid');
  }
}
