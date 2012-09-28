<?php

/**
 * DynamicContainerForm
 *
 * @package    symfext
 * @subpackage form
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class DynamicContainerForm extends BaseForm
{
  public function getFormJavascripts()
  {
    return array('/js/general/sfDynamicFormEmbedder.js');
  }
}
