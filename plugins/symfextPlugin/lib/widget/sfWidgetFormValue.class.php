<?php

/**
 * sfWidgetFormValue
 * 
 * Represents a value to display.
 * 
 * @package    symfext
 * @subpackage widget
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfWidgetFormValue extends sfWidgetForm
{
  /**
   * Configures the widget.
   * 
   * Available options:
   *
   *  * value:        The value to display (required)
   * 
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('value');
  }

  /**
   * Renders the widget.
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
    return $this->getOption('value');
  }
}
