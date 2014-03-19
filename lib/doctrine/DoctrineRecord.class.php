<?php

/**
 * DoctrineRecord
 *
 * @package    polosac
 * @subpackage doctrine
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
abstract class DoctrineRecord extends sfDoctrineRecordExt
{
  public function loadNextCode()
  {
    if (!$this->getCode())
    {
      $this->setCode($this->getTable()->findNextCode());
    }
  }
}
