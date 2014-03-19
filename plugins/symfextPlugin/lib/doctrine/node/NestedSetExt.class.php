<?php

/**
 * Doctrine_Node_NestedSetExt
 *
 * @package    symfext
 * @subpackage node
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class Doctrine_Node_NestedSetExt extends Doctrine_Node_NestedSet
{
  protected
    $parent = null;
  
  /**
   * Returns the parent node.
   * 
   * Lazy loads the parent record and saves it to
   * the parent attribute for future calls.
   *
   * @param boolean $refresh If true, forces the parent reloading
   *
   * @return DoctrineRecord The parent record
   *
   * @see Doctrine_Node_NestedSet
   */
  public function getParent($refresh = false)
  {
    if (null === $this->parent || $refresh)
    {
      $this->parent = parent::getParent();
    }
    
    return $this->parent;
  }
  
  /**
   * Sets the current parent record temporally.
   *
   * @param DoctrineRecord $parent The parent record
   */
  public function setParent($parent)
  {
    $this->parent = $parent;
  }
  
  /**
   * @see Doctrine_Node_NestedSet
   */
  public function getChildren()
  {
    $children = parent::getChildren();
    return $children ? $children : array();
  }
  
  /**
   * Returns the number of children.
   * 
   * @return integer The number of children
   */
  public function getChildrenNumber()
  {
    $children = parent::getChildren();
    return $children ? count($children) : 0;
  }
  
  /**
   * @see Doctrine_Node_NestedSet
   */
  public function getAncestors()
  {
    $ancestors = parent::getAncestors();
    return $ancestors ? $ancestors : array();
  }
  
  /**
   * Returns the first ancestor from the hierarchy.
   * 
   * @return DoctrineRecord The first ancestor
   */
  public function getRoot()
  {
    if ($ancestors = $this->getAncestors())
    {
      return $ancestors->getFirst();
    }
  }
}
