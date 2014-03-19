<?php

/**
 * Doctrine_Template_Thumbnailable
 * 
 * Easily create a thumbnail for any field on a record.
 * 
 * This class needs the sfImageTransformPlugin to work properly.
 * 
 * @package     symfext
 * @subpackage  template
 * @author      David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class Doctrine_Template_Thumbnailable extends Doctrine_Template
{
  /**
   * Creates a thumbnail from the image of the field value.
   * 
   * @param  string  $field  The name of the field
   * @param  integer $width  The desired width (200 by default)
   * @param  integer $height The desired height (if null defaults to the width)
   */
  public function createThumbnail($field, $width = 200, $height = null)
  {
    $file_directory = $this->getInvoker()->getFileDirectory($field);
    
    if (is_file($file_directory))
    {
      $thumbnail      = new sfImageExt($file_directory);

      $height         = null === $height ? $width : $height;
      $thumbnail_name = $this->processThumbnailFileName($file_directory, $width);
      
      $thumbnail->thumbnail($width, $height, 'scale');
      $thumbnail->setQuality(80);
      $thumbnail->saveAs($thumbnail_name);
    }
  }
  
  /**
   * Deletes the thumbnails of the given field.
   * 
   * This method should be used in the removeFile method of the model.
   * 
   * @param  string  $field  The name of the field
   */
  public function deleteThumbnails($field)
  {
    if ($this->getInvoker()->$field)
    {
      $file_directory = $this->getInvoker()->getFileDirectory($field);
      
      $directory = substr($file_directory, 0, strrpos($file_directory, '/'));
      $file_name = substr($file_directory, strrpos($file_directory, '/') + 1);
      $file_name = substr($file_name, 0, strrpos($file_name, '.'));
      
      $files     = sfFinder::type('file')->name($file_name.'_*')->in($directory);
      foreach ($files as $file)
      {
        unlink($file);
      }
    }
  }
  
  /**
   * Returns whether or not the thumbnail exists for a field.
   * 
   * @param  string  $field  The name of the field
   * @param  integer $width  The width of the thumbnail)
   * 
   * @return boolean True if the thumbnail exists, false otherwise
   */
  public function existsThumbnail($field, $width)
  {
    $path = $this->getThumbnailFileDirectory($field, $width);
    
    return is_file($path) && file_exists($path);
  }
  
  /**
   * Returns the complete name of the thumbnail file.
   * 
   * @example C:\wamp\www\flexiwik_1.0\web\uploads\category_images\example_200px.jpg
   * 
   * @param  string  $field  The field name
   * @param  integer $width  The width of the thumbnail
   *
   * @return string The complete name of the thumbnail file
   */
  public function getThumbnailFileDirectory($field, $width)
  {
    $file_directory = $this->getInvoker()->getFileDirectory($field);
    
    return $this->processThumbnailFileName($file_directory, $width);
  }
  
  
  /**
   * Returns a thumbnail file name from a path.
   * 
   * @example 
   *   Given:
   *   /flexiwik_1.0/web/uploads/category_images/example.jpg
   *   
   *   Returns:
   *   /flexiwik_1.0/web/uploads/category_images/example_200px.jpg
   *   
   * @param  string  $path   The path
   * @param  integer $width  The width of the thumbnail
   *
   * @return string The thumbnail file name
   */
  public function processThumbnailFileName($path, $width)
  {
    $file_name = substr($path, 0, strrpos($path, '.'));
    $extension = substr($path, strrpos($path, '.'));
    
    return sprintf('%s_%spx%s', $file_name, $width, $extension);
  }
  
  /**
   * Returns the complete path of the thumbnail file.
   * 
   * @example /flexiwik_1.0/web/uploads/category_images/example_200px.jpg
   * 
   * If the thumbnail does not exist then blank is returned.
   * 
   * @param  string  $field  The field name
   * @param  integer $width  The width of the thumbnail
   *
   * @return string The complete path of the thumbnail file
   */
  public function getThumbnailFilePath($field, $width)
  {
    $file_path = $this->getInvoker()->getFilePath($field);
    
    return $this->existsThumbnail($field, $width) ? $this->processThumbnailFileName($file_path, $width) : '';
  }
  
  /**
   * Crops and saves an image file.
   * 
   * @param  string $field       The field name
   * @param  array  $coordinates The coordinates of the new image
   */
  public function cropImage($field, $coordinates)
  {
    $image_path = $this->getInvoker()->getFileDirectory($field);
    $image      = new sfImageExt($image_path);
    $image->crop($coordinates['left'], $coordinates['top'], $coordinates['width'], $coordinates['height']);
    $image->saveAs($image_path);
  }
}
