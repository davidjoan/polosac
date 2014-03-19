<?php

/**
 * sfWebRequestExt
 * 
 * @package    symfext
 * @subpackage request
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfWebRequestExt extends sfWebRequest
{
  /**
   * Returns a parameter located in an array.
   * 
   * Useful when the name of the array is not known.
   * 
   * @param string $inner_param The param to look for
   * 
   * @return string The value of the param
   */
  public function getInnerParameter($inner_param)
  {
    foreach ($this->getParameterHolder()->getNames() as $name)
    {
      $param = $this->getParameter($name);
      if (is_array($param) && isset($param[$inner_param]))
      {
        return $param[$inner_param];
      }
    }
  }
  
  /**
   * Returns the name of and array with an inner param.
   * 
   * Useful when the name of the array is not known.
   * 
   * @param string $inner_param The param to look for
   * 
   * @return string The name of the array
   */
  public function getNameWithInnerParameter($inner_param)
  {
    foreach ($this->getParameterHolder()->getNames() as $name)
    {
      $param = $this->getParameter($name);
      if (is_array($param) && isset($param[$inner_param]))
      {
        return $name;
      }
    }
  }
  
  /**
   * Returns the value of an inner parameter.
   * 
   * @param string $name        The name of the array
   * @param string $inner_param The param to look for
   * 
   * @return string The value of the param
   */
  public function getParameterFromArray($name, $inner_param)
  {
    $param = $this->getParameter($name);
    if (is_array($param) && isset($param[$inner_param]))
    {
      return $param[$inner_param];
    }
  }
  
  /**
   * Returns the remote IP address that made the request.
   * 
   * FIXME: index REMOTE_ADDR not present when running scripts from command line
   * 
   * @return string The remote IP address
   */
  public function getRemoteAddress()
  {
    $pathInfo = $this->getPathInfoArray();

    return isset($pathInfo['REMOTE_ADDR']) ? $pathInfo['REMOTE_ADDR'] : '127.0.0.1';
  }
}
