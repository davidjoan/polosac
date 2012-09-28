<?php

/**
 * sfDoctrineCollectionExt
 *
 * @package    symfext
 * @subpackage doctrine
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfDoctrineCollectionExt extends Doctrine_Collection
{
  /**
   * Removes a record from the collection.
   * 
   * @param DoctrineRecord The record to be removed
   */
  public function removeRecord(DoctrineRecord $record)
  {
    $key = $this->search($record);
    if (false !== $key)
    {
      $this->remove($key);
    }
  }
  
  /**
   * Restored the removed records using the last snapshot from the collection.
   */
  public function restoreRemoved()
  {
    foreach ($this->getDeleteDiff() as $record)
    {
      $this->add($record);
    }
  }
  
  /**
   * Returns an array of DoctrineTemplate objects base on the collection.
   * 
   * @param boolean $force If true forces the conversion
   * 
   * @return array[DoctrineTemplate] An array of DoctrineTemplate objects
   */
  public function toTemplates($force = true)
  {
    $template_class = $this->getTable()->getComponentName().'Template';
    
    if (class_exists($template_class))
    {
      $templateResults = array();
      foreach ($this as $record)
      {
        $templateResults[] = new $template_class($record);
      }
      
      return $templateResults;
    }
    
    if ($force)
    {
      throw new RuntimeException(sprintf('The "%s" class does not exist. You can\'t convert a sfDoctrineCollectionExt to a collection of templates without the template class', $template_class));
    }
    
    return $this;
  }
  
  /**
   * Returns an array of data base on the fields parameter.
   * 
   * @param array $fields The fields array with the keys and methods to apply to the collection
   * 
   * @return array An array with the result of the fields array methods
   */
  public function toCustomArray($fields)
  {
    $array = array();
    $i     = 1; // for problems with the json_encode function, an index must be set explicitly
    
    $templates = $this->toTemplates(false);
    foreach ($templates as $template)
    {
      foreach ($fields as $field => $getter)
      {
        $array[$i][$field] = $template->$getter();
      }
      
      $i++;
    }
    
    return $array;
  }
  
  /**
   * Applies a method to each record of the collection.
   * 
   * @param string $method    The method to apply
   * @param array  $arguments The arguments of the method
   * 
   * @param boolean True if no error arises.
   */
  public function apply($method, $arguments)
  {
    foreach ($this as $record)
    {
      call_user_func_array(array($record, $method), (array) $arguments);
    }
    
    return true;
  }
}
