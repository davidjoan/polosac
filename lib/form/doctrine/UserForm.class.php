<?php

/**
 * User form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserForm extends BaseUserForm
{
  public function initialize()
  {
    $this->labels = array
    (
      'realname'         => 'Nombres y Apellidos',
      'username'         => 'Nombre de Usuario',
      'password'         => 'Contrase&ntilde;a',
      'confirm_password' => 'Confirma Password',
      'email'            => 'Correo Electr&oacute;nico',
      'url'              => 'Url',
      'phone'            => 'Telefono',
      'active'           => 'Activo',
    );
  }
  
  public function configure()
  {
  	$this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'realname'             => new sfWidgetFormInputText(array(), array('size' => 30)),
      'username'             => new sfWidgetFormInputText(array(), array('size' => 30)),
      'password'             => new sfWidgetFormInputPassword(array(), array('size' => '30')),
      'confirm_password'     => new sfWidgetFormInputPassword(array(), array('size' => '30')),
      'email'                => new sfWidgetFormInputText(array(), array('size' => 30)),
      'url'                  => new sfWidgetFormInputText(array(), array('size' => 30)),
      'phone'                => new sfWidgetFormInputText(array(), array('size' => 15)),
      'active'               => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getStatuss(),
                                  'expanded'         => true,
                                  'renderer_options' => array('formatter' => array($this->widgetFormatter, 'radioFormatter'))
                                ))
    ));
    $this->setDefault('active', '1');
    $this->validatorSchema['confirm_password'] = new sfValidatorString(array('max_length' => 255));    
      	
  	$this->types = array
    (
      'id'               => '=',
      'realname'         => 'name',
      'username'         => 'user',
      'password'         => 'password',
      'confirm_password' => 'password',
      'email'            => 'email',
      'url'              => 'url',
      'phone'            => 'phone',
      'active'           => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'last_access_at'   => '-',
      'slug'             => '-',
      'created_at'       => '-',
      'updated_at'       => '-',
    );
    

    
    if (!$this->isNew())
    {
      $this->validatorSchema['password']->setOption('required', false);
      $this->validatorSchema['confirm_password']->setOption('required', false);
    }
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array
    (
      new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('username'))),
      new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('email'))),
      new sfValidatorSchemaCompare
      (
        'password', sfValidatorSchemaCompare::EQUAL, 'confirm_password',
        array('throw_global_error' => true),
        array('invalid'            => 'Los campos \'%password%\' y \'%confirm_password%\' deben ser iguales.')
      )
    )));
  }
  
  protected function updatePasswordColumn($password)
  {
    return empty($password) ? false : $password;
  }
  
  protected function updateEmailColumn($email)
  {
    return Stringkit::strtolower($email);
  }
}