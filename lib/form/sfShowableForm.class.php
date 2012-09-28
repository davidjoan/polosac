<?php

/**
 * sfShowableForm.
 *
 * @package    form
 */
class sfShowableForm implements ArrayAccess, Countable
{
  protected
    $form = null;

  public function __construct(sfForm $form)
  {
    $this->form = $form;
    $this->transform($this->form);
  }

  public function transform(sfForm $form)
  {
    $form->setOption('required_labels', false);
    $form->initialize();
    $form->setup();
    $form->configure();

    if ($form instanceof StockProductForm)
    {
      $this->customStockProduct($form);
    }

    $form->setWidgetSchema($this->transformSchema($form->getWidgetSchema(), $form));

    foreach ($form->getEmbeddedForms() as $key => $embeddedForm)
    {
      $widgetSchema = $form->getWidgetSchema();
      if (isset($widgetSchema[$key]))
      {
        $this->transform($embeddedForm);
        $label = $form->getWidgetSchema()->getLabel($key);
        $form->embedForm($key, $embeddedForm);
        $form->getWidgetSchema()->setLabel($key, strip_tags($label));
      }
    }

    $form->updateSchemas();
  }
  public function transformSchema($widgetSchema, $form)
  {
    foreach ($widgetSchema->getFields() as $name => $widget)
    {
      $field = sfInflector::camelize($name);
      if ($widget instanceof sfWidgetFormI18nChoiceCountry)
      {
        $countries = sfCultureInfo::getInstance('es')->getCountries();
        $widgetSchema[$name] = new sfWidgetFormValue(array('value' => $countries[$form->getObject()->$name]));
      }
      elseif ($widget instanceof sfWidgetFormDoctrineChoice || $widget instanceof sfWidgetFormDoctrineJQueryAutocompleter)
      {
        $widgetSchema[$name] = new sfWidgetFormValue(array('value' => $form->getObject()->{'get'.$widget->getOption('model').'Name'}()));
      }
      elseif ($widget instanceof sfWidgetFormJQueryCompleter)
      {
        $widgetSchema[$name] = new sfWidgetFormValue(array('value' => call_user_func($widget->getOption('value_callback'), $form->getObject()->$name)));
      }
      elseif ($widget instanceof sfWidgetFormChoice || $widget instanceof sfWidgetFormSelect || $widget instanceof sfWidgetFormDoctrineDependentSelect)
      {
        $widgetSchema[$name] = new sfWidgetFormValue(array('value' => $form->getObject()->{'get'.sfInflector::camelize($name).'Name'}()));
      }
      elseif ($widget instanceof sfWidgetFormDate)
      {
        $value = $form->getObject()->$name ? sfContext::getInstance()->getUser()->getDateTimeFormatter()->format($form->getObject()->$name, 'D') : '';
        $widgetSchema[$name] = new sfWidgetFormValue(array('value' => $value));
      }
      elseif ($widget instanceof sfWidgetFormValue)
      {
      }
      elseif ($widget instanceof sfWidgetFormSchema)
      {
        $widgetSchema[$name] = $this->transformSchema($widget, $form->getEmbeddedForm($name));
      }
      elseif (
      !$widget instanceof sfWidgetFormInputHidden &&
      !$widget instanceof sfWidgetFormJavascript &&
      !$widget instanceof sfWidgetFormInputPassword
      )
      {
        try
        {
          if (in_array($form->getType($name), array('fixed_number', 'phone')))
          {
            throw new Exception();
          }
          
          if ($form->getType($name) == 'float')
          {
            $widgetSchema[$name] = new sfWidgetFormValue(array('value' => $form->getObject()->{'getFormatted'.$field}()));
          }
          else
          {
            $value = $form->getObject()->$name;
            $value = is_numeric($value) ? number_format($value, 2): $value;
            $widgetSchema[$name] = new sfWidgetFormValue(array('value' => $value));
          }
        }
        catch (Exception $e)  // cost fields
        {
          $widgetSchema[$name] = new sfWidgetFormValue(array('value' => $form->getDefault($name)));
        }
      }
      else
      {
        unset($widgetSchema[$name]);
      }
    }

    return $widgetSchema;
  }

  public function __toString()
  {
    return $this->form->__toString();
  }

  
  
  
  
  protected function customStockProduct($form)
  {
    if ($form->getObject()->isFromImport())
    {
      $form->fixForImport(false);
    }
    elseif ($form->getObject()->isFromNationalPurchase())
    {
      $form->fixForNationalPurchase(false);
    }

    $form->fixForSingle();
  }

  
  
  
  
  
  public function __call($method, $arguments)
  {
    return call_user_func_array(array($this->form, $method), $arguments);
  }
  
  public function offsetExists($name)
  {
    return isset($this->form[$name]);
  }
  public function offsetGet($name)
  {
    return $this->form[$name];
  }
  public function offsetSet($offset, $value)
  {
    return $this->form[$offset] = $value;
  }
  public function offsetUnset($offset)
  {
    unset($this->form[$offset]);
  }
  public function count()
  {
    return count($this->form);
  }
}
