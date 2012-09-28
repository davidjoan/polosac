<?php

/**
 * BusTemplate
 *
 * @package    polosac
 * @subpackage model
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class BusTemplate extends DoctrineTemplate
{
  public function getDisableImage()
  {
    $image  = 'backend/';
  	$image .= $this->isActive() ? 'user_active.gif' : 'user_inactive.gif';
  	
    return image_tag($image, array('title' => $this->getActiveName()));
  }
}
