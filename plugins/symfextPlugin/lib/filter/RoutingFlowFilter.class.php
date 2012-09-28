<?php

/**
 * RoutingFlowFilter
 *
 * @package    symfext
 * @subpackage filter
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 * @see        RoutingFlow
 */
class RoutingFlowFilter extends sfFilter
{
  /**
   * Saves a four level stack with the last four browsed routes 
   * according the browse module.
   *
   * @param sfFilterChain $filterChain The current filter chain
   */
  public function execute($filterChain)
  {
  	$current_route_name = $this->getRouting()->getCurrentRouteName();
  	$routes             = $this->getRouting()->getRoutes();
  	$route              = $routes[$current_route_name];
  	
  	$defaults = $route->getDefaults();
  	if (isset($defaults['rflow']))
    {
  	  $module    = $this->getContext()->getRequest()->getParameter('module');
  	  $namespace = constant(sprintf('ActionsProject::%s_NAMESPACE', strtoupper(sfInflector::underscore($module))));
      $this->flow($namespace);
    }
    
    if (isset($defaults['rf_module']))
  	{
  	  $modules = explode(',', $defaults['rf_module']);	
  	  foreach ($modules as $module)
  	  {
  	    $namespace = constant(sprintf('ActionsProject::%s_NAMESPACE', strtoupper(sfInflector::underscore($module))));
  	    $this->flow($namespace);
  	  }
  	}
  	
    $filterChain->execute();
  }
  
  /**
   * Saves a four level stack with the last four browsed routes
   * according a namespace.
   *
   * @param sfFilterChain $filterChain The current filter chain
   */
  protected function flow($namespace)
  {
  	$user = $this->getContext()->getUser();
  	
  	// adding three reminders for the last three actions according to the namespace
  	$current_route = $this->getRouting()->getCurrentInternalUri(true);
  	$user->setAttribute('third_last_route' , $user->getAttribute('second_last_route', null, $namespace), $namespace);
  	$user->setAttribute('second_last_route', $user->getAttribute('first_last_route' , null, $namespace), $namespace);
  	$user->setAttribute('first_last_route' , $user->getAttribute('current_route'    , null, $namespace), $namespace);
  	$user->setAttribute('current_route'    , $current_route, $namespace);
  }
  
  /**
   * Returns the current routing object.
   *
   * @return sfPatternRouting The routing object
   */
  protected function getRouting()
  {
  	return $this->getContext()->getRouting();
  }
}
