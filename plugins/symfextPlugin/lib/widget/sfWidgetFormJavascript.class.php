<?php

/**
 * sfWidgetFormJavascript
 * 
 * Represents some javascript to display.
 * 
 * @package    symfext
 * @subpackage widget
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfWidgetFormJavascript extends sfWidgetForm
{
  /**
   * Configures the widget.
   * 
   * Available options:
   *
   *  * js:            The javascript code to embed (required)
   *  * include:       An array of javascript files to include
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('js');
    $this->addOption('include'  , array());
    $this->setOption('is_hidden', true);
  }
  
  /**
   * Renders some javascript code with javascript tags as a widget.
   * 
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    return javascript_tag(sprintf('var id = "%s"; %s;', $this->generateId($name), $this->getOption('js')));
  }
  
  /**
   * @see sfWidget
   */
  public function getJavascripts()
  {
    return $this->getOption('include');
  }
}
