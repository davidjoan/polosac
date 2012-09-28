<?php use_stylesheet(sfConfig::get('sf_app').'/modules/crud.css') ?>
<?php use_javascript('general/crud.js') ?>

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
  
    <?php include_partial('Crud/buttons_show') ?>
  
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
  
    <?php include_partial('Crud/buttons_show') ?>
  </div>
</div>

<?php echo javascript_tag('giveEditToggle()') ?>
