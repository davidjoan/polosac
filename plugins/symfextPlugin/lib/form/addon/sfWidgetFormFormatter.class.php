<?php

/**
 * sfWidgetFormFormatter
 * 
 * @package    symfext
 * @subpackage form
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfWidgetFormFormatter
{
  /**
   * Renders the widget with a radio format.
   *
   * @param  sfWidgetFormChoiceBase $widget The current widget
   * @param  array                  $inputs An array with the input components
   *
   * @return string                 The rendered widget
   */
  public function radioFormatter($widget, $inputs)
  {
    $rows  = array();
    $count = 0;
    foreach ($inputs as $input)
    {
      $count++;
      $br = $count % 4 === 0 ? '<br/><br/>' : '';
      $rows[] = $input['input'].$widget->getOption('label_separator').'&nbsp;'.$input['label'].$br;
    }
    
    return implode('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $rows);
  }
  
  /**
   * Renders the widget with a long radio format.
   *
   * @param  sfWidgetFormChoiceBase $widget The current widget
   * @param  array                  $inputs An array with the input components
   *
   * @return string                 The rendered widget
   */
  public function longRadioFormatter($widget, $inputs)
  {
    $rows = array();
    foreach ($inputs as $input)
    {
      $rows[] = $input['input'].$widget->getOption('label_separator').'&nbsp;'.$input['label'];
    }
    
    return implode('<br/>', $rows);
  }
  
  /**
   * Renders the widget with a checkbox format.
   *
   * @param  sfWidgetFormChoiceBase $widget The current widget
   * @param  array                  $inputs An array with the input components
   *
   * @return string                 The rendered widget
   */
  public function checkboxFormatter($widget, $inputs)
  {
    $rows = array();
    foreach ($inputs as $input)
    {
      $rows[] = $input['input'].$widget->getOption('label_separator').'&nbsp;'.$input['label'];
    }
    
    return implode('<br/>', $rows);
  }
  
  /**
   * Returns the common template for the sfWidgetFormInputFileEditable widget.
   *
   * @param  DoctrineRecord $object The current object
   * @param  string         $field  The field with the image
   *
   * @return string         The widget template
   */
  public function getInputFileImageTemplate($object, $field)
  {
    if ($object->isNew() || !$object->$field)
    {
      $template = '%input%<br/>%delete% %delete_label%';
    }
    else
    {
      $template = '<a href="%s">%%file%%</a><br />%%input%%<br />%%delete%% %%delete_label%%';
      $template = sprintf($template, $object->getFilePath($field));
    }
    
    return $template;
  }
  
  /**
   * Returns the standard date format for the date widget.
   *
   * @return string
   */
  public function getStandardDateFormat()
  {
    return '%day%&nbsp;-&nbsp;%month%&nbsp;-&nbsp;%year%';
  }
  
  /**
   * Returns a short date format for the date widget.
   *
   * @return string
   */
  public function getShortDateFormat()
  {
    return '%day%-%month%-%year%';
  }
  
  /**
   * Returns the standard format for the time widget.
   *
   * @return string
   */
  public function getStandardTimeFormat()
  {
    return '&nbsp;%hour%:%minute%';
  }
}
