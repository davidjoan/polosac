<?php slot('title') ?>
  Buses
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Bus: <?php echo $form->getObject()->getCode() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
