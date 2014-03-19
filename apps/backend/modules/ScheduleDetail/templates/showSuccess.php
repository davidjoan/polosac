<?php slot('title') ?>
  Asignaciones
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Asignacion: <?php echo $form->getObject()->getBusName() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
