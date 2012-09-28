<?php

/**
 * sfTesterFileSystem implements tests for the file system related extensions.
 *
 * @package    symfext
 * @subpackage test
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfTesterFileSystem extends sfTester
{
  /**
   * @see sfTester
   */
  public function prepare()
  {
  }

  /**
   * @see sfTester
   */
  public function initialize()
  {
  }

  /**
   * Tests whether or not a given directory exists.
   *
   * @param string  $dir     The directory
   * @param boolean $boolean If true check if the directory exists
   *
   * @return sfTestFunctionalBase|sfTester
   */
  public function isDir($dir, $boolean = true)
  {
    if ($boolean)
    {
      $this->tester->isDir($dir, sprintf('"%s" is a directory indeed', $dir));
    }
    else
    {
      $this->tester->isntDir($dir, sprintf('"%s" is not a directory indeed', $dir));
    }
    
    return $this->getObjectToReturn();
  }
  
  /**
   * Tests whether or not a given file exists.
   *
   * @param string  $file    The file
   * @param boolean $boolean If true check if the file exists
   *
   * @return sfTestFunctionalBase|sfTester
   */
  public function isFile($file, $boolean = true)
  {
    if ($boolean)
    {
      $this->tester->isFile($file, sprintf('"%s" is a file indeed', $file));
    }
    else
    {
      $this->tester->isntFile($file, sprintf('"%s" is not a file indeed', $file));
    }
    
    return $this->getObjectToReturn();
  }
  
  /**
   * Tests whether or not a given link exists.
   *
   * @param string  $link    The link
   * @param boolean $boolean If true check if the link exists
   *
   * @return sfTestFunctionalBase|sfTester
   */
  public function isLink($link, $boolean = true)
  {
    if ($boolean)
    {
      $this->tester->isLink($link, sprintf('"%s" is a link indeed', $link));
    }
    else
    {
      $this->tester->isntLink($link, sprintf('"%s" is not a link indeed', $link));
    }
    
    return $this->getObjectToReturn();
  }
  
  /**
   * Tests if two files exist and are equal.
   *
   * @param string $file_1 The first file
   * @param string $file_2 The second file
   *
   * @return sfTestFunctionalBase|sfTester
   */
  public function areEqualFiles($file_1, $file_2)
  {
    $this->isFile($file_1);
    $this->isFile($file_2);
    
    $this->tester->is(getimagesize($file_1), getimagesize($file_2), sprintf('"%s" and "%s" are indeed the same file', $file_1, $file_2));
    
    return $this->getObjectToReturn();
  }
}
