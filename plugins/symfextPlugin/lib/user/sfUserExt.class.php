<?php

/**
 * sfUserExt
 *
 * @package    symfext
 * @subpackage user
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
abstract class sfUserExt extends sfBasicSecurityUser
{
  protected
    $datetimeFormatter = null,
    $numberFormatter   = null;
    
  /**
   * Initializes the user object.
   * 
   * @param sfEventDispatcher $dispatcher  An sfEventDispatcher instance.
   * @param sfStorage         $storage     An sfStorage instance.
   * @param array             $options     An associative array of options.
   *
   * @see sfBasicSecurityUser
   */
  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    parent::initialize($dispatcher, $storage, $options);
    
    $this->datetimeFormatter = new sfDateFormat($this->culture);
    $this->numberFormatter   = new sfNumberFormat($this->culture);
  }
  
  /**
   * Returns the current date formatter instance.
   * 
   * @return DateFormat The current date formatter instance
   */
  public function getDatetimeFormatter()
  {
    return $this->datetimeFormatter;
  }
  
  /**
   * Returns the current number formatter instance.
   * 
   * @return NumberFormat The current number formatter instance
   */
  public function getNumberFormatter()
  {
    return $this->numberFormatter;
  }
  
  /**
   * Sets authentication for user.
   *
   * @param  bool $authenticated
   * 
   * @see sfBasicSecurityUser
   */
  public function setAuthenticated($authenticated)
  {
    $this->updateUserLastAccess();
    
    if (false === $authenticated)
    {
      $this->removeProjectNamespaces();
    }
    
    parent::setAuthenticated($authenticated);
  }
  
  /**
   * Updates the last access field from the db user.
   */
  abstract public function updateUserLastAccess();
  
  /**
   * Removes the namespaces from attribute holder based on 
   * ActionsProject constants.
   */
  public function removeProjectNamespaces()
  {
    $class = new ReflectionClass('ActionsProject');
    foreach ($class->getConstants() as $name => $value)
    {
      if (substr($name, -9) == 'NAMESPACE')
      {
        $this->getAttributeHolder()->removeNamespace($value);
      }
    }
  }
  
  /**
   * Gets the current route name.
   *
   * @return string The route name
   * 
   * @see sfPatternRouting
   */
  public function getCurrentRouteName()
  {
    return '@'.sfContext::getInstance()->getRouting()->getCurrentRouteName();
  }
  
  /**
   * Returns true if the application is in the target environment.
   *
   * @return boolean Whether or not the application is in the target environment
   */
  public function isEnvironment($env)
  {
    return sfContext::getInstance()->getConfiguration()->getEnvironment() == $env;
  }
}
