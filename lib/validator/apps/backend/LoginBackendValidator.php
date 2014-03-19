<?php

/**
 * LoginBackendValidator.
 *
 * @package    polosac
 * @subpackage validator
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class LoginBackendValidator extends sfGlobalValidator
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addRequiredOption('model');
    $this->addRequiredOption('column');
    $this->addRequiredOption('find_method');
    
    $this->setMessage('invalid'            , 'El campo "%column%" es incorrecto.');
    $this->addMessage('wrong_password'     , 'La contrase&ntilde;a que ha introducido no coinciden.');
    $this->addMessage('inactive'           , 'Su cuenta est&aacute; inactiva. P&oacute;ngase en contacto con el administrador del sistema.');
  }
  
  protected function doClean($values)
  {
    if ($this->hasEmptyValues($values))
    {
      return $values;
    }
    
    $columns     = (array) $this->getOption('column');
    $find_method = $this->getOption('find_method');
    $user        = Doctrine::getTable($this->getOption('model'))->$find_method($values[$columns[0]]);
    
    $arguments   = array();
    if (!$user)
    {
      $error     = 'invalid';
      $arguments = array('column' => implode(', ', $columns));
    }
    elseif (!kcCrypt::compare($user->getPassword(), $values[$columns[1]]))
    {
      $error     = 'wrong_password';
    }
    elseif (!$user->isActive())
    {
      $error     = 'inactive';
    }
    else
    {
      return $values;
    }
    
    throw new sfValidatorError($this, $error, $arguments);
  }
}