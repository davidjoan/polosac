<?php

/**
 * sfActionsCrud
 * 
 * Contains general methods to give the CRUD functionality.
 *
 * @package    symfext
 * @subpackage action
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
abstract class sfActionsCrud extends ActionsProject
{
  protected
    /**
     * @example CategoryAttributeActions
     */
    $usClass    = '', // category_attribute, underscore class name
    $modelClass = '', // CategoryAttribute
    $tableClass = '', // CategoryAttributeTable
    $formClass  = '', // CategoryAttributeForm
    $namespace  = ''; // retrieved from the constant self::CATEGORY_ATTRIBUTE_NAMESPACE
    
  /**
   * Initializes the instance attributes.
   * 
   * @see sfAction
   */
  public function initialize($context, $moduleName, $actionName)
  {
  	parent::initialize($context, $moduleName, $actionName);
  	
    $class_name       = get_class($this);
    $class_name       = substr($class_name, 0, strpos($class_name, 'Actions'));
    $this->usClass    = sfInflector::underscore($class_name);
    $this->modelClass = $class_name;
    $this->tableClass = $this->modelClass.'Table';
    $this->formClass  = $this->modelClass.'Form';
    $this->namespace  = constant(sprintf('self::%s_NAMESPACE', strtoupper($this->usClass)));
    
    $request = sfContext::getInstance()->getRequest();
    $request->setParameter('usClass'   , $this->usClass);
    $request->setParameter('modelClass', $this->modelClass);
    $request->setParameter('tableClass', $this->tableClass);
    $request->setParameter('formClass' , $this->formClass);
    $request->setParameter('namespace' , $this->namespace);
  }
  
  /**
   * Executes the general list base on the instance attributes.
   * 
   * Creates a query, configures it according complementList and
   * configureList hook methods and then assigns it to a pager.
   * 
   * @param sfWebRequest $request The current sfWebRequest object
   */
  public function executeList(sfWebRequest $request)
  {
    $q = Doctrine::getTable($this->modelClass)->createAliasQuery();
    $q->filterAndArrange($this->getFilterAndArrangeParameters($request), $this->getExtraFilterAndArrangeFields());
    $this->complementList($request, $q);
    $this->configureList($request, $q);
    $this->setCrudPager($request, $q);
  }
  
  /**
   * @see executeList
   */
  protected function getFilterAndArrangeParameters(sfWebRequest $request)
  {
    return $request->getParameterHolder()->getAll();
  }
  
  /**
   * @see executeList
   */
  protected function getExtraFilterAndArrangeFields()
  {
    return array();
  }
  
  /**
   * @see executeList
   */
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
  }
  
  /**
   * @see executeList
   */
  protected function configureList(sfWebRequest $request)
  {
  }
  
  /**
   * Executes the general edition base on the instance attributes.
   * 
   * Creates a form base on the class name, configures it 
   * according complementObject and configureEdit hook methods.
   * 
   * If a post request it validates and saves the form.
   * 
   * @param sfWebRequest $request The current sfWebRequest object
   */
  public function executeEdit(sfWebRequest $request)
  {
    $slug         = $request->getParameter('slug', '');
    $this->object = Doctrine::getTable($this->modelClass)->findOneBySlug($slug);
    $this->complementObject($request);
    $this->form   = new $this->formClass($this->object);
    $this->complementEdit($request);
    if ($request->isMethod('post'))
    {
      $params = $request->getParameter($this->form->getName());
     // Deb::print_r($params);
      $this->form->bind($params, $request->getFiles($this->form->getName()));
      
      if ($this->form->isValid())
      {
        $obj = $this->form->save();
        $this->complementSave($request);
        $this->redirect($this->getEntranceRoute());
      }
    }
  }
  
  /**
   * @see executeList
   */
  protected function complementObject(sfWebRequest $request)
  {
  }
  
  /**
   * @see executeList
   */
  protected function complementEdit(sfWebRequest $request)
  {
  }
  
  /**
   * @see executeList
   */
  protected function complementSave(sfWebRequest $request)
  {
  }
  
  /**
   * Executes the general deletion base on the instance attributes.
   * 
   * @throws sfExceptionExt if an error occurred while deleting the objects 
   * 
   * @param sfWebRequest $request The current sfWebRequest object
   */
  public function executeDelete(sfWebRequest $request)
  {
    $slugs = $request->getParameter('slug');
    $slugs = explode(',', $slugs);
    $this->forward404Unless($slugs);
    
    try
    {
      Doctrine::getTable($this->modelClass)->deleteBySlugs($slugs);
    }
    catch (sfExceptionExt $e)
    {
      $this->redirect('@error_delete_error');
    }
    
    $this->redirect($this->getEntranceRoute());
  }
  
  /**
   * @see sfActionsExt
   */
  protected function setCrudPager(sfWebRequest $request, DoctrineQuery $q)
  {
    parent::setPager($this->modelClass, $request, $q);
  }
  
  /**
   * Executes the general sorting using the sort method of the table class.
   * 
   * @param sfWebRequest $request The current sfWebRequest object
   * 
   * @return sfView::NONE
   */
  public function executeSort(sfWebRequest $request)
  {
    $order = $request->getParameter('item', array());
    
    Doctrine::getTable($this->modelClass)->sort($order);
    
    return sfView::NONE;
  }
}
