<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();
require_once(dirname(__FILE__).'/../plugins/symfextPlugin/config/sfProjectConfigurationExt.class.php');

class ProjectConfiguration extends sfProjectConfigurationExt
{
  protected function getActivePlugins()
  {
    return array
           (
             'sfDoctrinePlugin',
             'symfextPlugin'
           );
  }
  
  protected function setConfigVariables()
  {
    
    parent::setConfigVariables();
   // sfConfig::set('sf_web_path','/');
   // sfConfig::set('site_name', 'CUSA Site');
    //$this->setWebDir($this->getRootDir().'/public_html');
    
  //  $this->setConfigDirPathVariable('brand_images'         , sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'brand_images'         );
    //$this->setConfigDirPathVariable('company_image_images'         , sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'company_images'         );
   // $this->setConfigDirPathVariable('post' , sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'post' );
   // $this->setConfigDirPathVariable('photo', sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'photo');
     }
}