<?php

/**
 * ActionsCrud
 *
 * @package    polosac
 * @subpackage action
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
abstract class ActionsCrud extends sfActionsCrud
{
  public function executeShow(sfWebRequest $request)
  {
    $slug      = $request->getParameter('slug', '');
    $this->obj = Doctrine::getTable($this->modelClass)->findOneBySlug($slug);
    $this->forward404Unless($this->obj);
    
    $this->form = new $this->formClass($this->obj);
    $this->form = new sfShowableForm($this->form);
  }
}
