<?php

/**
 * sfDynamicFormEmbedder embeds dynamically a form in another form and
 * manages all its functionality. 
 *
 * @package    symfext
 * @subpackage form
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 * @TODO       Move all the view related info to a new renderer class, to leave just
 *             the functionality logic in here.
 */
class sfDynamicFormEmbedder
{
  protected static
    $decorator = "<table id=\"%s\" class=\"embedded_form\">\n <tr>\n<th class=\"title\" colspan=\"100\">\n %%label%% \n</th>\n</tr>\n %%content%% \n</table>",
    $key       = '987654321';
  
  protected
    $name                      = '',
    $relation                  = '',
    $parentForm                = null,
    $containerLabel            = '',
    $containerForm             = null,
    $existentChildObjects      = null,
    $childFormCreationCallable = null,
    
    $imageAdd                  = '',
    $imageLoading              = '',
    $imageRemove               = '';
  
  /**
   * Constructor
   *
   * @param string             $name                      The name of the embedded form
   * @param Doctrine_Relation  $relation                  The target relation
   * @param BaseForm           $parentForm                The parent form in which to embed
   * @param BaseForm           $containerForm             The form that will contain the child dynamic forms
   * @param DoctrineCollection $existentChildObjects      The current child objects
   * @param sfCallable         $childFormCreationCallable The callable to use when creating a new form for a child object
   */
  public function __construct($name, $relation, BaseForm $parentForm, BaseForm $containerForm, $existentChildObjects, sfCallable $childFormCreationCallable)
  {
    $this->name                      = $name;
    $this->relation                  = $relation;
    $this->parentForm                = $parentForm;
    $this->containerLabel            = sfInflector::humanize($this->getContainerName());
    $this->containerForm             = $containerForm;
    $this->existentChildObjects      = $existentChildObjects;
    $this->childFormCreationCallable = $childFormCreationCallable;
    
    $this->imageAdd                  = 'general/icons/add.png';
    $this->imageLoading              = 'general/snake.gif';
    $this->imageRemove               = 'general/icons/delete.png';
  }
  
  /**
   * Embeds the container form into the parent form.
   */
  public function embed()
  {
    $current_count = self::getFormsCount($this->name);
    $removed_list  = self::getRemovedList($this->name);
    
    $containerForm = clone $this->containerForm;
    
    $count = 0;
    foreach ($this->existentChildObjects as $childObject)
    {
      $count++;
      if (in_array($count, $removed_list))
      {
        $this->parentForm->getObject()->{$this->relation}->removeRecord($childObject);
        continue;
      }
      
      $this->addChildFormToContainerForm($count, $containerForm, $childObject);
    }
    
    if ($count == 0 && $current_count == 0) // no form embedded yet, must be at least one when starting
    {
      $current_count++;
    }

    if ($count < $current_count) // already added forms
    {
      $count++;
      for ($count = $count; $count <= $current_count; $count++)
      {
        if (in_array($count, $removed_list))
        {
          continue;
        }
        
        $this->addChildFormToContainerForm($count, $containerForm);
      }
    }
    
    if ($current_count == 0)
    {
      $current_count = $count;
    }
    $this->parentForm->embedForm($this->getContainerName(), $containerForm, $this->getContainerDecorator());
    $this->parentForm->getWidgetSchema()->setLabel($this->getContainerName(), $this->getContainerLabel().'&nbsp;'.$this->getLinkAdd());
    
    self::setFormsCount($this->name, $current_count);
  }
  
  /**
   * Saves in session a template of a new child form that will be used when
   * adding a new form dynamically. This method should be called once the 
   * whole form is built, that is when all the form names are set up.
   */
  public function saveTemplateForm()
  {
    $containerForm = clone $this->containerForm;
    
    $this->addChildFormToContainerForm(self::$key, $containerForm);
    
    $parentForm = clone $this->parentForm;
    $parentForm->embedForm($this->getContainerName(), $containerForm, $this->getContainerDecorator());
    
    $form = $parentForm[$this->getContainerName()][self::$key]->renderRow();
    
    self::setFormTemplate($this->name, $form);
  }
  
  /**
   * Adds a child form to the container.
   * 
   * @param string   $count         The name of the embedded form
   * @param BaseForm $containerForm The container form
   * @param BaseForm $containerForm The child object
   */
  protected function addChildFormToContainerForm($count, $containerForm, $childObject = null)
  {
    $childForm = $this->childFormCreationCallable->call($childObject);
    $containerForm->embedForm($count, $childForm, $this->getChildDecorator($count));
    $containerForm->getWidgetSchema()->setLabel($count, $count.'&nbsp;'.$this->getLinkRemove($count));
  }
  
  /**
   * Returns the decorator to embed the child form.
   * 
   * @param string  $count         The name of the embedded form
   * 
   * @return string The decorator
   */
  protected function getChildDecorator($count)
  {
    return sprintf(self::$decorator, $this->name.'_'.$count);
  }
  
  /**
   * Returns the decorator to embed the container form.
   * 
   * @param string  $count         The name of the embedded form
   * 
   * @return string The decorator
   */
  protected function getContainerDecorator()
  {
    return sprintf(self::$decorator, $this->getContainerName());
  }
  
  /**
   * Returns the container name.
   * 
   * @return string The name
   */
  public function getContainerName()
  {
    return $this->name.'_container';
  }
  
  /**
   * Returns the parent form.
   * 
   * @return BaseForm
   */
  public function getParentForm()
  {
    return $this->parentForm;
  }
  
  /**
   * Returns the container label.
   * 
   * @return string The label
   */
  public function getContainerLabel()
  {
    return $this->containerLabel;
  }
  
  /**
   * Sets the container label.
   * 
   * @param string $container_label The container label
   */
  public function setContainerLabel($container_label)
  {
    $this->containerLabel = $container_label;
  }
  
  /**
   * Returns the path of the image for the add icon.
   * 
   * @return string The path of the image
   */
  public function getImageAdd()
  {
    return $this->imageAdd;
  }
  
  /**
   * Sets the path of the image for the add icon.
   * 
   * @param string $image_add The path of the image
   */
  public function setImageAdd($image_add)
  {
    $this->imageAdd = $image_add;
  }
  
  /**
   * Returns the path of the image for the loading icon.
   * 
   * @return string The path of the image
   */
  public function getImageLoading()
  {
    return $this->imageLoading;
  }
  
  /**
   * Sets the path of the image for the loading icon.
   * 
   * @param string $image_loading The path of the image
   */
  public function setImageLoading($image_loading)
  {
    $this->imageLoading = $image_loading;
  }
  
  /**
   * Returns the path of the image for the remove icon.
   * 
   * @return string The path of the image
   */
  public function getImageRemove()
  {
    return $this->imageRemove;
  }
  
  /**
   * Sets the path of the image for the remove icon.
   * 
   * @param string $image_remove The path of the image
   */
  public function setImageRemove($image_remove)
  {
    $this->imageRemove = $image_remove;
  }
  
  /**
   * Returns the html link to add a child form.
   * 
   * @return string The html link
   */
  protected function getLinkAdd()
  {
    $this->parentForm->loadHelpers(array('Asset', 'Tag', 'JavascriptBase', 'Url', 'Partial'));
    
    return link_to_function
           (
             image_tag($this->getImageAdd()), 
             sprintf
             (
               'addDynamicForm("%s", "%s", "%s", "%s", "%s", event)', 
               $this->name, 
               $this->getContainerName(), 
               sfConfig::get('sf_images_path').'/'.$this->getImageLoading(),
               url_for('@generic_get_attribute_value'), 
               url_for('@generic_add_dynamic_form')
             )
           );
  }
  
  /**
   * Returns the html link to remove a child form.
   * 
   * @return string The html link
   */
  protected function getLinkRemove($count)
  {
    $this->parentForm->loadHelpers(array('Asset', 'Tag', 'JavascriptBase', 'Url', 'Partial'));
    
    return link_to_function
           (
             image_tag($this->getImageRemove()), 
             sprintf
             (
               'removeDynamicForm("%s", "%s", "%s", event)', 
               $this->name, 
               $count, 
               url_for('@generic_remove_dynamic_form')
             )
           );
  }
  
  
  /**
   * Returns the html to use when adding a new child form.
   * 
   * @param string $name The name of the form
   * 
   * @return string The html form
   */
  public static function getProcessedFormTemplate($name)
  {
    $next_form_count = self::getFormsCount($name) + 1;
    self::setFormsCount($name, $next_form_count);
    
    $form = self::getFormTemplate($name);
    $form = str_replace(self::$key, $next_form_count, substr($form, 4, -6)); // replacing and deleting <tr></tr>

    return $form;
  }
  
  /**
   * Adds a form to the forms list to be removed.
   * 
   * @param string  $name        The name of the form
   * @param integer $forms_count The number of the form to be removed
   */
  public static function addToRemovedList($name, $form_count)
  {
    $removed_list = self::getRemovedList($name);
    
    $removed_list[] = $form_count;
    
    self::setRemovedList($name, $removed_list);
  }
  
  /**
   * Resets the main attributes that hold the state of the dynamic form.
   * 
   * @param string  $name The name of the form
   */
  public static function resetParams($name)
  {
    self::setFormsCount($name, 0);
    self::setRemovedList($name, array());
    self::setFormTemplate($name, '');
  }
  
  /**
   * Returns the current count of child forms.
   * 
   * @param string $name The name of the form
   * 
   * @return integer     The current count
   */
  public static function getFormsCount($name)
  {
    return self::getUser()->getAttribute($name.'_forms_count'  , 0             , ActionsProject::GENERAL_NAMESPACE);
  }
  
  /**
   * Sets the current count of child forms.
   * 
   * @param string  $name        The name of the form
   * @param integer $forms_count The current count
   */
  public static function setFormsCount($name, $forms_count)
  {
    self::getUser()->setAttribute($name.'_forms_count'  , $forms_count  , ActionsProject::GENERAL_NAMESPACE);
  }
  
  /**
   * Returns the current list of removed forms.
   * 
   * @param string $name The name of the form
   * 
   * @return array       The removed list
   */
  public static function getRemovedList($name)
  {
    return self::getUser()->getAttribute($name.'_removed_list' , array()       , ActionsProject::GENERAL_NAMESPACE);
  }
  
  /**
   * Sets the current list of removed forms.
   * 
   * @param string  $name         The name of the form
   * @param array   $removed_list The removed list
   */
  public static function setRemovedList($name, $removed_list)
  {
    return self::getUser()->setAttribute($name.'_removed_list' , $removed_list , ActionsProject::GENERAL_NAMESPACE);
  }
  
  /**
   * Returns the template of the child form.
   * 
   * @param string $name The name of the form
   * 
   * @return string      The child form template
   */
  public static function getFormTemplate($name)
  {
    return self::getUser()->getAttribute($name.'_form_template', ''            , ActionsProject::GENERAL_NAMESPACE);
  }
  
  /**
   * Sets the template of the child form.
   * 
   * @param string  $name          The name of the form
   * @param string  $form_template The child form template
   */
  public static function setFormTemplate($name, $form_template)
  {
    return self::getUser()->setAttribute($name.'_form_template', $form_template, ActionsProject::GENERAL_NAMESPACE);
  }
  
  /**
   * Returns the current user object.
   * 
   * @return sfUser The user
   */
  public static function getUser()
  {
    return sfContext::getInstance()->getUser();
  }
}
