<?php slot('title') ?>
  Lugares
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Lugar: <?php echo $form->getObject()->getName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
