<?php

/**
 * UserBackend.
 *
 * @package    polosac
 * @subpackage lib.user
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class UserBackend extends UserProject
{
public function getPermissions()
  {
    return $this->getAttribute('permissions', null, ActionsProject::USER_NAMESPACE);
  }
  
  protected function mapPermissions($user)
  {
    $permissions = $this->getActionsFromRole($user->getRole()->getCode());
    
    $this->setAttribute('permissions', $permissions, ActionsProject::USER_NAMESPACE);
  }
  
  protected function getActionsFromRole($code)
  {
    $actions = $this->getActions();
    switch ($code)
    {
      case RoleTable::ADMIN:
          $actions = $this->getActionsForAdmin($actions);
        break;
      case RoleTable::CLIENT:
        $actions = $this->getActionsForClient($actions);
        break;
    }
    
    return $actions;
  }
  
  protected function getActions()
  {
    $actions = array();
    foreach (sfContext::getInstance()->getRouting()->getRoutes() as $name => $route)
    {
      $defaults = $route->getDefaults();
      if (!isset($defaults['secure']) || $defaults['secure'])
      {
        $actions[$name] = true;
      }
    }
    
    return $actions;
  }
  
  public function hasPermissions($route_names, $strict = false)
  {
    foreach ($route_names as $route_names)
    {
      if ($this->hasPermission($route_names))
      {
        if (!$strict)
        {
          return true;
        }
      }
      else
      {
        if ($strict)
        {
          return false;
        }
      }
    }
    
    if ($strict)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function hasPermission($route_name)
  {
    $route_name = trim($route_name, '@');
    $routes = sfContext::getInstance()->getRouting()->getRoutes();
    if (isset($routes[$route_name]))
    {
      $defaults  = $routes[$route_name]->getDefaults();
      $secure    = isset($defaults['secure']) ? $defaults['secure'] : true;
    }
    else
    {
      $secure = true;
    }
    
    $permissions = $this->getPermissions();
    if (!$secure || isset($permissions[$route_name]))
    {
      return true;
    }
    
    return false;
  }
  
  public function getActionsForAdmin($actions)
  {       
    unset($actions['schedule_detail_delete']);
    return $actions;
  }
  
  public function getActionsForClient($actions)
  {
    $actions = array();
    
    $actions['schedule_detail_list'] = true;
    $actions['schedule_detail_edit'] = true;
    
    $actions['passenger_list'] = true;
    $actions['passenger_show'] = true;
    $actions['passenger_new'] = true;
    $actions['passenger_edit'] = true;
    
//    $actions['boarding_list'] = true;
//    $actions['boarding_show'] = true;
//    $actions['boarding_new'] = true;
//    $actions['boarding_edit'] = true;
    
    return $actions;
  }    
}
