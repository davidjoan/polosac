<?php

/**
 * sfDoctrineTemplateExt
 *
 * @package    symfext
 * @subpackage doctrine
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
abstract class sfDoctrineTemplateExt
{
  protected
    $object = null;
    
  /**
   * Constructor
   *
   * @param DoctrineRecord $object The doctrine record object
   */
  public function __construct(DoctrineRecord $object)
  {
    $this->object = $object;
  }
  
  /**
   * Renders a HTML content tag.
   *
   * @param string $tag         The tag name
   * @param string $content     The content of the tag
   *
   * @param string An HTML tag string
   */
  public function renderContentTag($tag, $content)
  {
    if (empty($tag))
    {
      return '';
    }
    
    return sprintf('<%s>%s</%s>', $tag, $content, $tag);
  }
  
  /**
   * Magic method used for method overloading.
   *
   * @param  string $method        Name of the method
   * @param  array  $arguments     Method arguments
   * 
   * @return mixed                 The return value of the given method
   */
  public function __call($method, $arguments)
  {
    return call_user_func_array(array($this->object, $method), $arguments);
  }
}
