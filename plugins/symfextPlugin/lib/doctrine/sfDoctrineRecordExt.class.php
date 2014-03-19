<?php

/**
 * sfDoctrineRecordExt
 *
 * @package    symfext
 * @subpackage doctrine
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
abstract class sfDoctrineRecordExt extends sfDoctrineRecord
{
  protected
    $wasNew = false; // true if and only if this record was new and then save just one time

  /**
   * Returns true if the column is modified.
   *
   * @param string $column The column to evaluate
   *
   * @return boolean True if the column is modified, otherwise false
   */
  public function isColumnModified($column)
  {
    return in_array($column, $this->_modified);
  }
  
  /**
   * Returns whether or not the record was new.
   * 
   * This method and its variable are used to avoid this:
   * 
   * [code]
   *   $is_new = $this->isNew();
   *   
   *   parent::save($con);
   *   
   *   if ($is_new)
   *   {
   *     ...
   *   }
   * [/code]
   *
   * @return boolean True if the record was new, otherwise false
   */
  public function wasNew()
  {
    return $this->wasNew;
  }
  
  /**
   * @see Doctrine_Record
   */
  public function save(Doctrine_Connection $conn = null)
  {
    $this->wasNew = $this->isNew();
    
    parent::save($conn);
  }
  
  /**
   * Deletes this data access object and all the related composites.
   *
   * Also deletes all the files associated with this record.
   *
   * @param Doctrine_Connection $conn The connection
   *
   * @return boolean True if successful
   * 
   * @see Doctrine_Record
   */
  public function delete(Doctrine_Connection $conn = null)
  {
    $ret = parent::delete($conn);

    foreach ($this->_data as $key => $val)
    {
      if ($this->getFieldDirectory($key))
      {
        $this->removeFile($key);
      }
    }
    
    return $ret;
  }
  
  /**
   * Returns the old value of the column.
   * 
   * @param string  $column The column to evaluate
   * 
   * @return mixed  The old value of the desired column
   */
  public function getOldValue($column)
  {
    return $this->getModifiedValue($column, true, false);
  }
  
  /**
   * Returns the modified value according the parameters.
   * 
   * @param string  $column The column to evaluate
   * @param boolean $old    Pick the old values (instead of the new ones)
   * @param boolean $last   Pick only lastModified values (@see getLastModified())
   * 
   * @return mixed  The value of the desired column
   * 
   * @see getModified
   */
  public function getModifiedValue($column, $old, $last)
  {
    $a = $this->getModified($old, $last);
    
    return $a[$column];
  }
  
  /**
   * Remove a given column from the modified array.
   * 
   * @param string  $column The column to unset
   */
  public function removeColumnModified($column)
  {
    if (in_array($column, $this->_modified))
    {
      foreach ($this->_modified as $key => $value)
      {
        if ($value == $column)
        {
          unset($this->_modified[$key]);
        }
      }
    }
  }
  
  /**
   * Magic method used for method overloading.
   * 
   * This method enhances the current symfony functionality, giving 
   * still more possibilities while striving for a rapid development.
   * 
   * 1.- Boolean Column
   * 
   *     The column tag as a boolean column in the model will support the methods: 
   *     
   *     a) is%column%()
   *     
   *        This method will return true if the current value of the field is equal 
   *        to DoctrineTable::YES, otherwise false.
   *     
   *        @example For an "active" column: $record->isActive();
   *     
   *        This column must be present in the array "boolean_columns" of the model
   *        options.
   *        
   *     b) get%column%Name()
   *        
   *        Returns the column value in text form according DoctrineTable class constants YES and NO.
   *        
   *        @example For an "active" column: $record->getActiveName();
   *        
   *        Will return 'Yes' if the current value of active is equal to DoctrineTable::YES.
   *     
   * 2.- Type Column
   * 
   *     The column tag as a type column in the model will support two methods:
   *     
   *     a) is%option%%field%()
   *        
   *        This method will return true if the current value of the field is
   *        the option. In the table class must exist the constants with all 
   *        the possible options of the current field.
   *        
   *        @example For a type colum with the options single, partial, complete
   *        
   *        In table:
   *        
   *        const
   *          TYPE_SINGLE    = 'S',
   *          TYPE_PARTIAL   = 'P',
   *          TYPE_COMPLETE  = 'C',
   *          
   *        Then isSingleType() will return true if the type field has the value 'S'.
   *        
   *     b) get%field%Name()
   *     
   *        Returns the current value of the field type but in text form.
   *        
   *        @example For a type colum with the options single, partial, complete
   *        
   *        In table:
   *        
   *        protected static
   *           $types = array
   *           (
   *             self::TYPE_SINGLE     => 'Single',
   *             self::TYPE_PARTIAL    => 'Partial',
   *             self::TYPE_COMPLETE   => 'Complete',
   *           );
   *        
   *        public function getTypes()
   *        {
   *          return self::$types;
   *        }
   *        
   *        Then getTypeName() will return 'Single' if the type field has the value 'S'.
   *        
   *     This column must be present in the array "type_columns" of the model
   *     options.
   *        
   * 3.- Relation column getter
   * 
   *     The record will have proxy methods for all the columns of its relations.
   *     
   *     get%relation%%column%()
   *     
   *     @example For a country relation with a field name on a user record.
   *     
   *     Then the method getCountryName() will return the name of the country.
   *     
   * 4.- Relation record existent
   * 
   *     The record can evaluate if a relation record exist: has%relation%.
   *     
   *     @example For a country relation with a field name on a user record.
   *     
   *     Then the method hasCountry() will return true if the user has a
   *     country object associated.
   *     
   * 5.- Addition of record to collection
   * 
   *     Easily a record can add another one to a collection.
   *     
   *     @example For country record which has a collection of users.
   *     
   *     Then the method $country->addUser($user) will add a new user to the 
   *     collection. This method is a proxy for $country->Users->add($user).
   *     
   * 
   * @param  string $method        Name of the method
   * @param  array  $arguments     Method arguments
   * 
   * @return mixed                 The return value of the given method
   */
  public function __call($method, $arguments)
  {
    try
    {
      $verb = substr($method, 0, 3);
      $name = substr($method, 3);
      if (substr($method, 0, 2) == 'is')
      {
        $name = sfInflector::underscore(substr($method, 2));
        if (in_array($name, (array) $this->getTable()->getOption('boolean_columns')))
        {
          return $this->$name == constant(get_class($this->getTable()).'::YES');
        }
        elseif ($column = $this->getTypeColumn($name))
        {
          return $column[1];
        }
        
        return parent::__call($method, $arguments);
      }
      elseif ($verb == 'get')
      {
        if (!strpos(sfInflector::underscore($name), '_'))
        {
          return parent::__call($method, $arguments);
        }
        
        foreach (array_keys($this->getTable()->getSingleRelations()) as $relation)
        {
          $relation_name = substr($name, 0, strlen($relation));
          if ($relation_name == $relation)
          {
            $field = sfInflector::underscore(substr($name, strlen($relation)));
            if ($field && $field != 'id' && $field != 'Id') // warning when doing something like getAssociationDetailId
            {
              return $this->{'has'.$relation}() ? $this->$relation->$field : '';
            }
          }
        }
        
        if (substr($method, -4) == 'Name')
        {
          $name = substr($method, 3, strlen($method) - 7);
          if (!$name) // getName
          {
            return parent::__call($method, $arguments);
          }
          
          $name = sfInflector::underscore($name);
          if (in_array($name, (array) $this->getTable()->getOption('boolean_columns')))
          {
          	
            $assertions = $this->getTable()->getAssertions();
            //Deb::print_r_($assertions);
            //Deb::print_r($assertions);
            return $assertions[$this->$name];
          }
          elseif (in_array($name, (array) $this->getTable()->getOption('type_columns')))
          {
            $types = $this->getTable()->{'get'.sfInflector::camelize($name).'s'}();
            return $types[$this->$name];
          }
        }
      }
      elseif ($verb == 'has')
      {
        return $this->relatedExists($name);
      }
      elseif ($verb == 'add')
      {
        $collectionName = $name.'s';

        return $this->$collectionName->add($arguments[0]);
      }
      
      return parent::__call($method, $arguments);
    }
    catch (Exception $e)
    {
      return parent::__call($method, $arguments);
    }
  }
  
  /**
   * Returns the processed type column.
   * 
   * @Warning
   * The columns "main_association_status" and "status" as type columns must be in
   * that order because in the opposite order the method will always invoke the 
   * status column.
   */
  protected function getTypeColumn($name)
  {
    $type_columns = (array) $this->getTable()->getOption('type_columns');
    foreach ($type_columns as $column)
    {
      $length = strlen($column);
      if (substr($name, -$length) == $column)
      {
        $class = new ReflectionClass(get_class($this->getTable()));
        $name     = substr($name, 0, strlen($name) - $length - 1);
        $constant = Inflector::constantize($column.'_'.$name);
        foreach ($class->getConstants() as $const => $value)
        {
          if ($constant == $const)
          {
            return array(1, $this->$column == $value);
          }
        }
      }
    }
  }
  
  /**
   * Returns the corresponding template instance of this model.
   * 
   * @param boolean $force Whether or not the method should force the conversion
   * 
   * @throws RuntimeException If force and the corresponding template class does not exist
   * 
   * @return DoctrineRecord|DoctrineTemplate The result of the conversion
   */
  public function toTemplate($force = true)
  {
    $template_class = $this->getTable()->getComponentName().'Template';
    
    if (class_exists($template_class))
    {
      $template = new $template_class($this);
      
      return $template;
    }
    
    if ($force)
    {
      throw new RuntimeException(sprintf('The "%s" class does not exist. You can\'t convert a sfDoctrineRecordExt to a template without the template class', $template_class));
    }
    
    return $this;
  }
  
  /**
   * Returns a new instance with the same data of this object except the id.
   *
   * @param  bool $deep Whether or not to act on relations
   *
   * @return DoctrineRecord The new populated record
   */
  public function duplicate($deep = true)
  {
    $newRecord = $this->getTable()->create();
    $data      = $this->toArray();
    $id        = $this->getTable()->getIdentifier();
    unset($data[$id]);
    $newRecord->fromArray($data, $deep);
    
    return $newRecord;
  }
  
  /****************************************************************************************
   * The following methods are related with the managing of files.
   *
   * In the Table of the model should exist two methods:
   *   * get%field%Dir   : Indicate the actual directory where the files should be saved.
   *   * get%field%Path  : Indicate the actual path of the file.
   *
   * These two methods are used by the following methods.
   */
  
  /**
   * Generates a filename based on the method and with a tree level path.
   *
   * The filename is generated with a random number to enforce uniqueness.
   *
   * @param  string          $field    The field of the file
   * @param  string          $method   The method to use to generate
   * @param  sfValidatedFile $file     The validated file to save
   *
   * @return string The generated filename
   */
  public function generateFilename($field, $method, sfValidatedFile $file)
  {
    $extension = Filekit::convertExtension($file->getExtension($file->getOriginalExtension()));
    $path      = Stringkit::fixFilename($this->$method()).$extension;
    $path      = rand(10000, 99999).'/'.$path;
    $hash      = Filekit::generateHashPathForLevel($path, 3);
    $filename  = $hash.'/'.$path;

    return trim($filename, '/');
  }
  
  /**
   * Removes the current file for the field.
   *
   * Tree ways of removing a file from a dotrine record:
   *  1.- Through the delete action.
   *  2.- Through the delete file button of the widget.
   *  3.- Updating with a new image, automatically deleting the old one.
   *
   *  In all of these DoctrineRecord::removeFile is used.
   *
   * @param string $field The field name
   */
  public function removeFile($field)
  {
    $file = $this->getFileDirectory($field);
    if (is_file($file))
    {
      unlink($file);
    }
  }
  
  /**
   * Saves the current file for the field.
   *
   * @param  sfValidatedFile $file     The validated file to save
   * @param  string          $filename The file name of the file to save
   *
   * @return string The filename used to save the file
   */
  public function saveFile(sfValidatedFile $file, $filename)
  {
    return $file->save($filename);
  }
  
  /**
   * Returns the complete directory of the field.
   *
   * @example C:\wamp\www\flexiwik_1.0\web\uploads\category_images
   *
   * @param   string $field  The field name
   *
   * @return  string The complete directory
   */
  public function getFieldDirectory($field)
  {
    $getFieldDirectory = sprintf('get%sDir', sfInflector::camelize($field));
    $directory         = method_exists($this->getTable(), $getFieldDirectory) ? $this->getTable()->$getFieldDirectory() : '';

    return $directory;
  }
  
  /**
   * Returns the complete path of the field directory.
   *
   * @example /flexiwik_1.0/web/uploads/category_images
   *
   * @param  string $field  The field name
   *
   * @return string The complete path
   */
  public function getFieldPath($field)
  {
    $getFieldPath = sprintf('get%sPath', sfInflector::camelize($field));
    $path         = method_exists($this->getTable(), $getFieldPath) ? $this->getTable()->$getFieldPath() : '';

    return $path;
  }
  
  /**
   * Returns the complete name of the file.
   *
   * @example C:\wamp\www\flexiwik_1.0\web\uploads\category_images\example.jpg
   *
   * @param  string $field  The field name
   *
   * @return string The complete name of the file
   */
  public function getFileDirectory($field)
  {
    return $this->getFieldDirectory($field).'/'.$this->$field;
  }
  
  /**
   * Returns the complete path of the file.
   *
   * @example /flexiwik_1.0/web/uploads/category_images/example.jpg
   *
   * @param  string $field  The field name
   *
   * @return string The complete path of the file
   */
  public function getFilePath($field)
  {
    return $this->getFieldPath($field).'/'.$this->$field;
  }
}
