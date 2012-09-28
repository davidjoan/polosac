<?php

/**
 * RoutingFilter
 *
 * @package    symfext
 * @subpackage filters
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class RoutingFilter extends sfFilter
{
  public function execute($filterChain)
  {
  	$user = $this->getContext()->getUser();
	
  	// adding three reminders for the last three actions
  	$current_route = $this->getContext()->getRouting()->getCurrentInternalUri(true);
  	$user->setAttribute('third_last_route' , $user->getAttribute('second_last_route'));
  	$user->setAttribute('second_last_route', $user->getAttribute('first_last_route'));
  	$user->setAttribute('first_last_route' , $user->getAttribute('current_route'));
  	$user->setAttribute('current_route'    , $current_route);
  	
  	$user->setAttribute('current_route_name', $this->getContext()->getRouting()->getCurrentRouteName());
  	
  	$filterChain->execute();
  }
}
