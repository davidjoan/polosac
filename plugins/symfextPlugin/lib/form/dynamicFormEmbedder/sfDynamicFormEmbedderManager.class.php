<?php

/**
 * sfDynamicFormEmbedderManager manages the creation of a sfDynamicFormEmbedder object. 
 *
 * @package    symfext
 * @subpackage form
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfDynamicFormEmbedderManager
{
  protected
    $relation     = null,
    $foreignAlias = '',
    $dynamicForm  = null;
    
  /**
   * Constructor
   *
   * @param string             $name                      The name of the embedded form
   * @param Doctrine_Relation  $relation                  The target relation
   * @param string             $label                     The container form label
   * @param BaseForm           $parentForm                The parent form in which to embed
   * @param sfCallable         $creationCallable          The callable to use when creating a new form for a child object
   * @param sfCallable         $collectionGetterCallable  The callable to use when trying to retrieve the current existent child objects
   */
  public function __construct($name, $relation, $label, $parent, $creationCallable = null, $collectionGetterCallable = null)
  {
    $this->initialize($name, $relation, $label, $parent, $creationCallable, $collectionGetterCallable);
  }
  
  /**
   * @see __construct
   */
  public function initialize($name, $relation, $label, $parent, $creationCallable = null, $collectionGetterCallable = null)
  {
    $this->relation            = $relation;
    $this->foreignAlias        = $this->getForeignAlias($relation);
    
    $containerForm             = new DynamicContainerForm();
    $childFormCreationCallable = null === $creationCallable         ? new sfCallable(array($this, 'getNewChildForm')) : $creationCallable;
    $existentChildObjects      = null === $collectionGetterCallable ? $parent->getObject()->{$relation['alias']}      : $collectionGetterCallable->call();
    
    $this->dynamicForm         = new sfDynamicFormEmbedder($name, $relation['alias'], $parent, $containerForm, $existentChildObjects, $childFormCreationCallable);
    $this->dynamicForm->setContainerLabel($label);
    $this->dynamicForm->embed();
    
    sfContext::getInstance()->getEventDispatcher()->connect(sprintf('form.%s.post_configure', $parent->getName()), array($this, 'parentFormPostConfigure'));
  }
  
  /**
   * Returns the alias of the child objects in the relation.
   * 
   * @param Doctrine_Relation The relation
   * 
   * @return string The foreign alias
   */
  protected function getForeignAlias($relation)
  {
    foreach (Doctrine::getTable($relation['class'])->getRelations() as $rel)
    {
      if ($rel['local'] == $relation['foreign'])
      {
        return $rel['alias'];
      }
    }
  }
  
  /**
   * Returns a new child form
   * 
   * @param DoctrineRecord $childObject The child object
   * 
   * @return BaseForm The child form
   */
  public function getNewChildForm($childObject = null)
  {
    if (null === $childObject)
    {
      $childObject = new $this->relation['class']();
      $childObject->{$this->foreignAlias} = $this->dynamicForm->getParentForm()->getObject();
    }
    
    $childFormClass = $this->relation['class'].'Form';
    $childForm = new $childFormClass($childObject);
    $childForm->deactivateValidation();
    
    return $childForm;
  }
  
  /**
   * Saves the child form template.
   * 
   * This method must be called after the parent form is totally built.
   */
  public function parentFormPostConfigure()
  {
    $this->dynamicForm->saveTemplateForm();
  }
  
  /**
   * Returns the current relation.
   * 
   * @return Doctrine_Relation The relation
   */
  public function getRelation()
  {
    return $this->relation;
  }
  
  /**
   * Returns the current dynamic form instance.
   * 
   * @return sfDynamicFormEmbedder The dynamic form
   */
  public function getDynamicForm()
  {
    return $this->dynamicForm;
  }
}
