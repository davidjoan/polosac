<?php

/**
 * Generic actions.
 *
 * @package    symfext
 * @subpackage Generic
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class GenericActions extends ActionsProject
{
  /**
   * Executes an action that sent as response a session value.
   * 
   * @param sfWebRequest $request The current request
   */
  public function executeGetAttributeValue(sfWebRequest $request)
  {
    $attribute = $request->getParameter('attribute');
    $namespace = $request->getParameter('namespace', null);
    $value     = $this->getUser()->getAttribute($attribute, array(), $namespace);
    
    return $this->renderJson($value);
  }
  
  /**
   * Adds a dynamic form to a main form.
   * 
   * @param sfWebRequest $request The current request
   * 
   * @see sfDynamicFormEmbedder
   */
  public function executeAddDynamicForm(sfWebRequest $request)
  {
    $form = sfDynamicFormEmbedder::getProcessedFormTemplate($request->getParameter('name'));
    
    return $this->renderText($form);
  }
  
  /**
   * Removes a dynamic form from a main form.
   * 
   * @param sfWebRequest $request The current request
   * 
   * @see sfDynamicFormEmbedder
   */
  public function executeRemoveDynamicForm(sfWebRequest $request)
  {
    sfDynamicFormEmbedder::addToRemovedList($request->getParameter('name'), $request->getParameter('form_count'));
    
    return sfView::NONE;
  }
}
