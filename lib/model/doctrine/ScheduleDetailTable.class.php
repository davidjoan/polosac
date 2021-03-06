<?php

/**
 * ScheduleDetailTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ScheduleDetailTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object ScheduleDetailTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ScheduleDetail');
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
  
  public function updateQueryForList(DoctrineQuery $q)
  {  
    $q->innerJoin('sd.Schedule s');
    $q->innerJoin('sd.Company c');
    $q->innerJoin('s.Bus b');
    $q->innerJoin('s.PlaceFrom pf');
    $q->innerJoin('s.PlaceFrom pt');    
    if(!sfContext::getInstance()->getUser()->isAdmin())
    {
      $q->addWhere('c.slug = ?',sfContext::getInstance()->getUser()->getCompanySlug());    
    }    
    
    $q->addWhere('sd.active = ?', 1);
    $q->addWhere('s.active = ?', 1);    
  }
    
    public function findOneBySlug($slug)
    {
    $q = $this->createAliasQuery()
         ->where('sd.id = ?', $slug);
         
    return $q->fetchOne();        
    
    }  
    
  public function getCalendarClient()
  { 
    $q = $this->createAliasQuery();
    $q->innerJoin('sd.Schedule s');
    $q->innerJoin('sd.Company c');
    $q->innerJoin('s.Bus b');
    $q->innerJoin('s.PlaceFrom pf');
    $q->innerJoin('s.PlaceFrom pt');
    if(!sfContext::getInstance()->getUser()->isAdmin())
    {
      $q->addWhere('c.slug = ?',sfContext::getInstance()->getUser()->getCompanySlug());    
    }    
    
    $q->addWhere('sd.active = ?', 1);
    $q->addWhere('s.active = ?', 1);
    
    return $q->execute();
  }    
}