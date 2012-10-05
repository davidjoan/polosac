<?php

/**
 * Bus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    polosac
 * @subpackage model
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Bus extends BaseBus
{
  public function __toString()
  {
      return $this->getName().' - ('.$this->getCode().') - '.$this->getPadron();
  }
  
  public function getFuelStr()
  {  	
  	$fuel = $this->getTable()->getFuel();
  	return $fuel[$this->getFuel()];
  }  
  
  
  public function getFuelName()
  {  	
  	$fuel = $this->getTable()->getFuel();
  	return $fuel[$this->getFuel()];
  }   
  
  public function getColorName()
  {  	
  	$colors = $this->getColors();
        
        $result = '<ul>';
        foreach($colors as $color)
            
        {
           $result.='<li>'.$color->getName().'</li>';
        }
        
        return $result.'</ul>';
  }  
  
  public function getVehicleUseName()
  {  	
  	$fuel = $this->getTable()->getUse();
  	return $fuel[$this->getVehicleUse()];
  }   
}
