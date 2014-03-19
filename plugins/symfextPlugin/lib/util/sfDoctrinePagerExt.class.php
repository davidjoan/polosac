<?php

/**
 * sfDoctrinePagerExt
 * 
 * @package    symfext
 * @subpackage util
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfDoctrinePagerExt extends sfDoctrinePager
{
  /**
   * Get all the results for the pager instance.
   *
   * This method was overwritten to convert the DoctrineRecords
   * to DoctrineTemplates objects if possible.
   *
   * @param mixed $hydrationMode A hydration mode identifier
   *
   * @return Doctrine_Collection|array
   */
  public function getResults($hydrationMode = null)
  {
    $results = parent::getResults($hydrationMode);
    
    try
    {
      $results = $results->toTemplates();
    }
    catch (RuntimeException $e) {}
    
    return $results;
  }
}
