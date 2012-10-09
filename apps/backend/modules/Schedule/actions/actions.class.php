<?php

/**
 * Schedule actions.
 *
 * @package    polosac
 * @subpackage Schedule
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScheduleActions extends ActionsCrud
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    sfDynamicFormEmbedder::resetParams('schedule_detail');
  }     
  
}
