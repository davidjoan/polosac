<?php use_stylesheet(sfConfig::get('sf_app').'/modules/crud.css') ?>
<?php use_javascript('general/crud.js') ?>

<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="crud_edit">
  <div class="background">
    <?php if (has_slot('title')): ?>
      <div class="title">
        <?php include_slot('title') ?>
      </div>
    <?php endif ?>
  
    <?php if (has_slot('subtitle')): ?>
      <div class="subtitle">
        <?php include_slot('subtitle') ?>
      </div>
    <?php endif ?>
  
    <?php include_partial('Crud/buttons_edit', array('object' => $object, 'right' => true)) ?>
  
  <?php if (has_slot('optional_content')): ?>
    <?php include_slot('optional_content') ?>
  <?php endif ?>
  
    <form 
      name="<?php echo $usClass ?>" 
      action="<?php echo $action_url ?>" 
      method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>
      autocomplete="<?php echo $autocomplete ?>"
    >
      <table class="form">
        <?php if ($with_title): ?>
          <tr>
            <th colspan="2" class="title">Info</th>
          </tr>
        <?php endif ?>
      
        <?php if (!has_slot('form')): ?>
          <?php echo $form ?>
        <?php else: ?>
          <?php include_slot('form') ?>
        <?php endif ?>
      </table>
    
      <input id="form_submit" type="submit" value="TestSave" style="display: none;"/> <!-- Just for testing compatibility -->
    </form>
  
    <?php if ($form->getOption('required_labels')): ?>
      <div class="required warning">* = Campos requeridos</div>
    <?php endif ?>
  
    <?php include_partial('Crud/buttons_edit', array('object' => $object, 'right' => true)) ?>
  </div>
</div>

<?php echo javascript_tag('giveEditToggle()') ?>
