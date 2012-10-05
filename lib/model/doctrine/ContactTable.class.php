<?php

/**
 * ContactTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ContactTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object ContactTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Contact');
    }
  const
    STATUS_ACTIVE       = 1,
    STATUS_INACTIVE     = 0;
    
  protected static
    $status                = array
                             (
                               self::STATUS_ACTIVE     => 'Si'  ,
                               self::STATUS_INACTIVE   => 'No',
                             );
                             
  public function getStatuss()
  {
    return self::$status;
  }    
}