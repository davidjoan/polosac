<?php

/**
 * sfPatternRoutingExt
 * 
 * @package    symfext
 * @subpackage routing
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfPatternRoutingExt extends sfPatternRouting
{
  /**
   * Gets the current route name.
   * 
   * Adds a @ at the beginning for normalization purposes.
   *
   * @return string The route name
   */
  public function getCurrentInternalRouteName()
  {
    return '@'.parent::getCurrentRouteName();
  }
}
