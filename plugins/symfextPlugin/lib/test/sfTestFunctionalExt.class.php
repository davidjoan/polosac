<?php

/**
 * sfTestFunctionalExt tests an application by using a browser simulator.
 *
 * @package    symfext
 * @subpackage test
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfTestFunctionalExt extends sfTestFunctional
{
  /**
   * Initializes the browser tester instance.
   *
   * @param sfBrowserBase $browser A sfBrowserBase instance
   * @param lime_test     $lime    A lime instance
   * @param array         $testers The testers to use
   */
  public function __construct(sfBrowserBase $browser, lime_test $lime = null, $testers = array())
  {
    $testers = array_merge
    (
      array
      (
        'doctrine'    => 'sfTesterDoctrine', 
        'file_system' => 'sfTesterFileSystem',
        'response'    => 'sfTesterResponseExt',
      ), 
      $testers
    );
               
    if (null === self::$test)
    {
      self::$test = null !== $lime ? $lime : new lime_test_ext();
    }
    
    parent::__construct($browser, $lime, $testers);
  }
  
  /**
   * Checks the current action.
   *
   * @param  string $module  Module name
   * @param  string $action  Action name
   * @param  string $code    The expected return status code
   *
   * @return sfTestFunctionalBase The current sfTestFunctionalBase instance
   */
  public function checkAction($module, $action, $code = 200)
  {
    return $this->
           with('request')->begin()->
             isParameter('module', $module)->
             isParameter('action', $action)->
           end()->
           with('response')->isStatusCode($code);
  }
}
