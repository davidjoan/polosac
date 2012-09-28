<?php

/**
 * LoginBackendForm.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class LoginBackendForm extends BaseForm
{
  public function initialize()
  {
    $this->labels = array
    (
      'username'             => 'Nombre',
      'password'             => 'Contrase&ntilde;a',
    );
    
    $this->setOption('required_labels', false);
  }
  
  public function configure()
  {
    $this->setWidgets(array
    (
      'username'             => new sfWidgetFormInputText(array(), array('size' => 40)),
      'password'             => new sfWidgetFormInputPassword(array(), array('size' => 40)),
    ));
    
    $this->setValidators(array
    (
      'username'             => new sfValidatorString(array('max_length' => 55)),
      'password'             => new sfValidatorString(array('max_length' => 55)),
    ));
    
    $this->types = array
    (
      'username'             => 'text',
      'password'             => 'password',
    );
    
    $this->validatorSchema->setPostValidator(new LoginBackendValidator(array
    (
      'model'       => 'User',
      'column'      => array('username', 'password'),
      'find_method' => 'findOneByLowerCaseUsername',
    )));
  }
}
