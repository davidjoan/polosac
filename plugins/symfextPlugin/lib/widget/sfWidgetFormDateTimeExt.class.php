<?php

class sfWidgetFormDateTimeExt extends sfWidgetFormDateTime
{
  protected function getDateWidget($attributes = array())
  {
    return new sfWidgetFormDateExt($this->getOptionsFor('date'), $this->getAttributesFor('date', $attributes));
  }
}
