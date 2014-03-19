<?php

/**
 * sfActionsExt
 * 
 * @package    symfext
 * @subpackage action
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
abstract class sfActionsExt extends sfActions
{
  /**
   * The constants resemble each of the project modules.
   */
  const
    CAPTCHA_NAMESPACE                  = 'Captcha',
    CRUD_NAMESPACE                     = 'Crud',
    ERROR_NAMESPACE                    = 'Error',
    GENERIC_NAMESPACE                  = 'Generic',
    PAGER_NAMESPACE                    = 'Pager';
    
  /**
   * Sets the general pager to use in actions.
   * 
   * @param string        $model   The model class
   * @param sfWebRequest  $request The request object
   * @param DoctrineQuery $q       The query object
   */
  protected function setPager($model, sfWebRequest $request, DoctrineQuery $q)
  {
    $pager = new sfDoctrinePagerExt($model, $request->getParameter('max'));
    $pager->setPage($request->getParameter('page'));
    $pager->setQuery($q);
    $pager->init();
    $this->pager = $pager;
  }
  
  protected function setPager2($model, sfWebRequest $request, DoctrineQuery $q)
  {
    $pager = new sfDoctrinePagerExt($model, $request->getParameter('max'));
    $pager->setPage($request->getParameter('page'));
    $pager->setQuery($q);
    $pager->init();
    $this->pager2 = $pager;
  }
  
  /**
   * Returns the last entrance route from the stack.
   * 
   * If the module parameter is given, the last route
   * returned is the one from the module.
   * 
   * @param  string  $module The module name
   * 
   * @return string  The last entrance route
   */
  protected function getEntranceRoute($module = null)
  {
    $module = $module ? $module : sfContext::getInstance()->getRequest()->getParameter('module');
    
    return Toolkit::getEntranceRoute($module);
  }
  
  /**
   * Appends the given array json encoded to the response content
   * and sets the content type to json.
   *
   * @param array $value The array to be converted to json
   *
   * @return sfView::NONE
   */
  protected function renderJson($value)
  {
    $this->getResponse()->setContentType('application/json');
    
    return $this->renderText(json_encode($value));
  }
  
  /**
   * Retrieves the current sfRouting object.
   *
   * @return sfRouting The current sfRouting implementation instance
   */
  protected function getRouting()
  {
    return $this->getContext()->getRouting();
  }
}
