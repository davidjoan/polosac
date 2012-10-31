<?php

/**
 * ScheduleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ScheduleTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object ScheduleTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Schedule');
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
    $q->innerJoin('s.Bus b');
    $q->innerJoin('s.PlaceFrom pf');
    $q->innerJoin('s.PlaceTo pt');
  }
  
  public function findOneByIdAndTravelDate($bus_id, $travel_date)
  {
    $q = $this->createAliasQuery();
    $q->addWhere('bus_id = ?', $bus_id);
    $q->addWhere(sprintf('DATE_FORMAT(%s, \'%%Y-%%m-%%d\') LIKE ?', 'travel_date'), $travel_date);
    
    return $q->execute()->count();
  }  
}