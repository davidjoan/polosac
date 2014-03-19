<?php

/**
 * FormExtHelper
 * 
 * A group of helpers to render tags.
 * 
 * @package    symfext
 * @subpackage helper
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */

/**
 * Returns an input text tag using the sfWidgetFormInputText class.
 * 
 * @param  string $name        The element name
 * @param  string $value       The value displayed in this widget
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string An HTML input text tag string
 *
 * @see sfWidgetFormInputText
 */
function input_tag($name, $value = null, $attributes = array(), $errors = array())
{
  $input = new sfWidgetFormInputText();
  return $input->render($name, $value, $attributes, $errors);
}

/**
 * Returns an input hidden tag using the sfWidgetFormInputHidden class.
 * 
 * @param  string $name        The element name
 * @param  string $value       The value displayed in this widget
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string An HTML input hidden tag string
 *
 * @see sfWidgetFormInputHidden
 */
function input_hidden_tag($name, $value = null, $attributes = array(), $errors = array())
{
  $input = new sfWidgetFormInputHidden();
  return $input->render($name, $value, $attributes, $errors);
}

/**
 * Returns a date html widget consisting of select tags using the sfWidgetFormDate class.
 * 
 * @param  string $name        The element name
 * @param  string $value       The value displayed in this widget
 * @param  array  $options     An array of options
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string HTML date selects tag strings
 *
 * @see sfWidgetFormDate
 */
function input_date_tag($name, $value = null, $options = array(), $attributes = array(), $errors = array())
{
  $input = new sfWidgetFormDate($options);
  return $input->render($name, $value, $attributes, $errors);
}

/**
 * Returns a filtered input text tag.
 * 
 * @param  string $name        The element name
 * @param  string $value       The value displayed in this widget
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string An HTML input text tag string
 */
function input_filter_tag($name, $value = null, $attributes = array(), $errors = array())
{
  $value = $value == '0' ? '' : Stringkit::fixFilter($value);
  return input_tag($name, $value, $attributes, $errors);
}

/**
 * Returns a select tag using the sfWidgetFormSelect class.
 * 
 * @param  string $name        The element name
 * @param  array  $choices     An array of possible choices
 * @param  string $selected    The value selected in this widget
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string A HTML select tag string
 *
 * @see sfWidgetFormSelect
 */
function select_tag($name, $choices, $selected = null, $attributes = array(), $errors = array())
{
  $select = new sfWidgetFormSelect(array('choices' => $choices));
  return $select->render($name, $selected, $attributes, $errors);
}

/**
 * Returns a checkbox tag using the sfWidgetFormInputCheckbox class.
 * 
 * @param  string $name        The element name
 * @param  string $checked     The this widget is checked if value is not null
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string An HTML input checkbox tag string
 *
 * @see sfWidgetFormInputCheckbox
 */
function checkbox_tag($name, $checked = false, $attributes = array(), $errors = array())
{
  $chkbox = new sfWidgetFormInputCheckbox();
  return $chkbox->render($name, $checked, $attributes, $errors);
}

/**
 * Returns a radiobutton tag using the sfWidgetFormSelectRadio class.
 * 
 * @param  string $name        The element name
 * @param  array  $choices     An array of possible choices
 * @param  string $selected    The value selected in this widget
 * @param  array  $options     An array of options
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string An HTML input radiobutton tag string
 *
 * @see sfWidgetFormSelectRadio
 */
function radiobutton_tag($name, $choices, $selected = null, $options = array(), $attributes = array(), $errors = array())
{
  $radio = new sfWidgetFormSelectRadio(array('choices' => $choices) + $options);
  return $radio->render($name, $selected, $attributes, $errors);
}

/**
 * Returns a select tag filled with the results from a model class.
 * 
 * @param  string $name        The element name
 * @param  array  $model       The model class
 * @param  string $selected    The value selected in this widget
 * @param  array  $options     An array of options
 * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
 * @param  array  $errors      An array of errors for the field
 *
 * @return string An HTML widget string
 *
 * @see sfWidgetFormDoctrineChoice
 */
function select_doctrine_tag($name, $model, $selected = null, $options = array(), $attributes = array(), $errors = array())
{
  $options = array_merge(array('model' => $model), $options);
  
  $widget = new sfWidgetFormDoctrineChoice($options);
  return $widget->render($name, $selected, $attributes, $errors);
}
