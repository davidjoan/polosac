<?php slot('title') ?>
  Pasajeros
<?php end_slot() ?>

<?php slot('subtitle') ?>
  Pasajero: <?php echo $form->getObject()->getNames() ?>
<?php end_slot() ?>

<?php include_component('Crud', 'show', array('form' => $form)) ?>
