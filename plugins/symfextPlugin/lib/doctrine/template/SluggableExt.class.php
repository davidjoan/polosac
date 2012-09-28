<?php

/**
 * Doctrine_Template_SluggableExt
 *
 * Easily create a slug for each record based on a specified set of fields
 *
 * @package    symfext
 * @subpackage template
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class Doctrine_Template_SluggableExt extends Doctrine_Template_Sluggable
{
  public function __construct(array $options = array())
  {
    $config  = array
               (
                 'builder'   => array('Inflector', 'urlize'),
                 'canUpdate' => true,
               );
    $options = array_merge($config, $options);
    
    parent::__construct($options);
  }
}
